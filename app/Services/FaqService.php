<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\FaqContract;
use App\Contracts\FaqDetailContract;
use App\Facades\Alert;
use App\Facades\Utility;
use Exception;

class FaqService
{
    private $faqContract;
    private $faqDetailContract;
    public function __construct(FaqContract $faqContract, FaqDetailContract $faqDetailContract)
    {
        $this->faqContract = $faqContract;
        $this->faqDetailContract = $faqDetailContract;
    }

    public function getLatestDataByLangId($languageId)
    {
        return $this->faqContract->fetchLatestDataByLanguageId($languageId);
    }


    public function yajraDataTable($languageId)
    {
        if (request()->ajax()) {

            $faq  = $this->faqContract->fetchLatestDataByLanguageIdWithRelation(['faqDetails'], $languageId);

            if(isset($faq->faqDetails))
                $faqDetails  = $faq->faqDetails;
            else
                $faqDetails = [];


            return datatables()->of($faqDetails)
                ->setRowId(function ($row) {
                    return $row->id;
                })
                ->addColumn('question', function ($row) {
                    return $row->question ?? '';
                })
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm"><i class="dripicons-trash"></i></button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function save($request, $languageId) : array
    {
        try {
            $data = $this->requestHandle($request);

            $this->faqUpdateOrCreate($data, $languageId);
            if ($request->is_allow) {
                $this->faqDetailSave($data, $languageId);
            }
            $result = Alert::successMessage('Data Submitted Successfully');

        } catch (Exception $exception) {
            $result = Alert::errorMessage($exception->getMessage());
        }

        return $result;
    }

    private function requestHandle($request)
    {
        $data = [
            'heading' => $request->heading,
            'sub_heading' => $request->sub_heading,
            'question' => $request->question,
            'answer' => $request->answer,
        ];
        return $data;
    }

    private function faqUpdateOrCreate($data, $languageId) : void
    {
        $firstCondition = [
            'language_id' => $languageId
        ];
        $this->faqContract->updateOrCreate($firstCondition, $data);

    }

    private function faqDetailSave($data, $languageId) : void
    {
        $data['position'] = $this->faqDetailContract->getMaxPosition() + 1;

        $module = $this->faqContract->fetchLatestDataByLanguageId($languageId);
        $secondCondition = [
            'faq_id' => $module->id,
            'question' => $data['question'],
            'answer' => $data['answer'],
        ];
        $this->faqDetailContract->updateOrCreate($secondCondition, $data);
    }

    public function updateInfo($request, $id)
    {
        try {
            $data = $this->requestHandle($request);
            $this->faqDetailContract->update($id, $data);

            return Alert::successMessage('Data Updated Successfully');

        } catch (Exception $exception) {
            return Alert::errorMessage($exception->getMessage());
        }
    }


    public function remove($id)
    {
        try {
            $this->faqDetailContract->delete($id);

            return Alert::successMessage('Data Deleted Successfully');

        } catch (Exception $exception) {
            return Alert::errorMessage($exception->getMessage());
        }
    }

    public function sortingDataTable($request)
    {
        try {
            $allPositionData = $this->faqDetailContract->all();
            foreach ($allPositionData as $item) {
                $item->timestamps = false; // To disable update_at field updation
                foreach ($request->order as $order) {
                    if ($order['id'] == $item->id) {
                        $data['position'] = $order['position'];
                        $this->faqDetailContract->update($item->id, $data);
                    }
                }
            }

            return Alert::successMessage('Order changed successfully');

        } catch (Exception $exception) {
            return Alert::errorMessage($exception->getMessage());
        }
    }


}

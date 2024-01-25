<?php

namespace App\Services;

use App\Contracts\ModuleContract;
use App\Contracts\ModuleDetailContract;
use App\Facades\Alert;
use App\Facades\Utility;
use Exception;

class ModuleService
{
    private $moduleContract;
    private $moduleDetailContract;

    public function __construct(ModuleContract $moduleContract, ModuleDetailContract $moduleDetailContract)
    {
        $this->moduleContract = $moduleContract;
        $this->moduleDetailContract = $moduleDetailContract;
    }

    public function yajraDataTable($languageId)
    {
        if (request()->ajax()) {

            $module  = $this->moduleContract->fetchLatestDataByLanguageIdWithRelation(['moduleDetails'], $languageId);

            if(isset($module->moduleDetails))
                $moduleDetails  = $module->moduleDetails;
            else
                $moduleDetails = [];

            return datatables()->of($moduleDetails)
                ->setRowId(function ($row) {
                    return $row->id;
                })
                ->addColumn('icon', function ($row) {
                    return '<i class="'.$row->icon.' text-primary"></i>&nbsp;'.$row->icon;
                })
                ->addColumn('name', function ($row) {
                    return $row->name ?? '';
                })
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm"><i class="dripicons-trash"></i></button>';

                    return $button;
                })
                ->rawColumns(['icon', 'action'])
                ->make(true);
        }
    }

    public function save($request, $languageId) : array
    {
        try {
            $maxPosition = $this->moduleDetailContract->getMaxPosition() + 1;
            $data = $this->requestHandle($request, $maxPosition);

            $firstCondition = [
                'language_id' => $languageId
            ];
            $imageName = Utility::imageFileHandle($request->image, $path='landlord/images/module/');
            if($imageName) {
                $data['image'] = $imageName;
            }
            $this->moduleContract->updateOrCreate($firstCondition, $data);

            if ($request->is_allow) {
                $module = $this->moduleContract->fetchLatestDataByLanguageId($languageId);
                $secondCondition = [
                    'module_id' => $module->id,
                    'name' => $data['name'],
                    'icon' => $data['icon'],
                ];
                $this->moduleDetailContract->updateOrCreate($secondCondition, $data);
            }
            $result = Alert::successMessage('Data Submitted Successfully');

        } catch (Exception $exception) {
            $result = Alert::errorMessage($exception->getMessage());
        }

        return $result;
    }

    public function updateInfo($request, $id)
    {
        try {
            $data = $this->requestHandle($request);
            $this->moduleDetailContract->update($id, $data);

            return Alert::successMessage('Data Updated Successfully');

        } catch (Exception $exception) {
            return Alert::errorMessage($exception->getMessage());
        }
    }

    public function remove($id)
    {
        try {
            $this->moduleDetailContract->delete($id);

            return Alert::successMessage('Data Deleted Successfully');

        } catch (Exception $exception) {
            return Alert::errorMessage($exception->getMessage());
        }
    }

    public function sortingDataTable($request)
    {
        try {
            $allPositionData = $this->moduleDetailContract->all();
            foreach ($allPositionData as $item) {
                $item->timestamps = false; // To disable update_at field updation
                foreach ($request->order as $order) {
                    if ($order['id'] == $item->id) {
                        $data['position'] = $order['position'];
                        $this->moduleDetailContract->update($item->id, $data);
                    }
                }
            }

            return Alert::successMessage('Order changed successfully');

        } catch (Exception $exception) {
            return Alert::errorMessage($exception->getMessage());
        }
    }

    private function requestHandle($request, $maxPosition = null)
    {
        $data = [
            'heading' => $request->heading,
            'sub_heading' => $request->sub_heading,
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon,
        ];

        if ($maxPosition) {
            $data['position'] = $maxPosition;
        }

        return $data;
    }
}

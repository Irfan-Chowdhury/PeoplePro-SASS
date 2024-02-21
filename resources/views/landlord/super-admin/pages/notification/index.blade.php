@extends('landlord.super-admin.layouts.master')
@section('landlord-content')


	<section>
		<div class="container">
			<div class="card">
                <div class="card-header text-center">
                    <h2>All Notifications</h2>
                </div>
				<div class="card-body">

						@foreach($all_notification as $notification)
							<div class="appointment-list-item">
							<a href={{$notification->data['link']}}>{{$notification->data['data']}}</a>
							</div>
						@endforeach

					@if(count($all_notification) > 0)
						<div class="text-center">
							<a href="{{route('clearAllNotification')}}" class="btn btn-link">{{__('Clear All')}}</a>
						</div>
					@else
						<p class="large-text dark-text text-center">{{__('No notifications for you at the moment!')}}</p>
					@endif
				</div>
			</div>
		</div>
	</section>


@endsection

@extends('backend.layouts.master')

@section('main-content')
 <!-- DataTales Example -->

 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3 tw-flex tw-justify-between ">
      <h6 class="m-0 font-weight-bold text-primary float-left">{{ __('Subcriber Lists') }}</h6>
      <button type="button" class="tw-text-white tw-bg-blue-700 tw-px-4 tw-py-2 tw-rounded hover:tw-bg-blue-800 hover:tw-text-white"><a class="hover:tw-text-white hover:tw-no-underline" href="{{route('export-subscibers')}}">Export subscriber list</a></button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($subcribers)>0)
        <table class="table table-bordered" id="subcriber-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>{{ __('Email') }}</th>
              <th>{{ __('Subcriber on') }}</th>
              <th>{{ __('Status') }}</th>
              <th>{{ __('Action') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>{{ __('Email') }}</th>
              <th>{{ __('Subcriber on') }}</th>
              <th>{{ __('Status') }}</th>
              <th>{{ __('Action') }}</th>
            </tr>
          </tfoot>
          <tbody>

            @foreach($subcribers as $subcriber)
                <tr>
                    <td>{{ $subcriber->email_subcriber }}</td>
                    <td>{{
                          date ('F j, Y, g:i a',
                          strtotime($subcriber->created_at))}}</td>
                    <td>
                      @php
                          $statusSubcriberActive = \App\Models\NewsletterSubcriber::STATUS_ACTIVE;
                      @endphp
                      <form class="form-check form-switch" id="subcriber-status-form">
                          <input class="form-check-input check-status-subcriber" @if($subcriber->status==$statusSubcriberActive) checked @endif 
                              type="checkbox" role="switch" id="flexSwitchCheckDefault_{{ $subcriber->id }}"
                              data-subscriber-id="{{ $subcriber->id }}">
                      </form>
                  </td>
                    <td>
                    <form method="POST" action="{{ route('subscriber.destroy', ['id' => $subcriber->id]) }}">
                      @csrf
                      @method('delete')
                          <button class="btn btn-danger btn-sm dltBtn-subscriber" data-id="{{$subcriber->id}}"
                                  style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                  data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i>
                          </button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        @else
          <h6 class="text-center">{{ __('No subcriber found!!!') }}</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      .zoom {
        transition: transform .2s; /* Animation */
      }

      .zoom:hover {
        transform: scale(5);
      }
  </style>
@endpush

@push('after_scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>

      $('#post-dataTable').DataTable({
          "columnDefs": [
              {
                  "orderable": false,
                  "targets": [4, 5]
              }
          ]
      });

        // Sweet alert

        function deleteData(id){

        }
  </script>
  <script src="{{ mix('js/backend/newsletter.js') }}"></script>
@endpush

@extends('layouts.app')

@section('content')
      <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-sm-12 col-12 m-auto">
                <form action="{{route('send-email')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card shadow">

                        @if(Session::has("success"))
                            <div class="alert alert-success alert-dismissible"><button type="button" class="close">&times;</button>{{Session::get('success')}}</div>
                        @elseif(Session::has("failed"))
                            <div class="alert alert-danger alert-dismissible"><button type="button" class="close">&times;</button>{{Session::get('failed')}}</div>
                        @endif

                        <div class="card-header">
                            <h4 class="card-title">Email Testing Tutorial</h4>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="emailRecipient">Email To </label>
                                <input type="email" name="emailRecipient" id="emailRecipient" class="form-control" placeholder="Mail To">
                            </div>

                            <div class="form-group">
                                <label for="emailCc">CC </label>
                                <input type="email" name="emailCc" id="emailCc" class="form-control" placeholder="Mail CC">
                            </div>

                            <div class="form-group">
                                <label for="emailBcc">BCC </label>
                                <input type="email" name="emailBcc" id="emailBcc" class="form-control" placeholder="Mail BCC">
                            </div>

                            <div class="form-group">
                                <label for="emailSubject">Subject </label>
                                <input type="text" name="emailSubject" id="emailSubject" class="form-control" placeholder="Mail Subject">
                            </div>

                            <div class="form-group">
                                <label for="emailBody">Message </label>
                                <textarea name="emailBody" id="emailBody" class="form-control" placeholder="Mail Body"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="emailAttachments">Attachment(s) </label>
                                <input type="file" name="emailAttachments[]" multiple="multiple" id="emailAttachments" class="form-control">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Send Email </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>

      @endsection

@push('scripts')

@endpush
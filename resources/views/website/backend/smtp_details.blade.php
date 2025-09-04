@extends('dashboard.admin.layouts.app')

@section('title')
    <title>{{ __('SMTP') }}</title>
@endsection
<div id="alert-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; max-width: 300px;">
    @if (session('success'))
        <div class="alert-message"
            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 14px; color: #fff; background: #47C363; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-message"
            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 14px; color: #fff; background: #ff0018; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
            {{ session('error') }}
        </div>
    @endif

    @if (session('info'))
        <div class="alert-message"
            style="padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; font-size: 14px; color: #fff; background: #17a2b8; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
            {{ session('info') }}
        </div>
    @endif
</div>


@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('SMTP') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('SMTP') }}</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills flex-column" id="emailTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link show active" id="setting-tab" data-toggle="tab" href=""
                                            role="tab" aria-controls="setting" aria-selected="true">SMTP</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade active show" id="setting_tab" role="tabpanel">
                                        <form action="{{ route('smtp.update') }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Sender Name</label>
                                                        <input type="text" name="mail_sender_name"
                                                            value="{{ $smtp->mail_sender_name }}" class="form-control">
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Mail Host</label>
                                                        <input type="text" name="mail_host"
                                                            value="{{ $smtp->mail_host }}" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">SMTP User Name</label>
                                                        <input type="text" name="mail_username"
                                                            value="{{ $smtp->mail_username }}" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">SMTP Password</label>
                                                        <input type="password" name="mail_password"
                                                            value="{{ $smtp->mail_password }}" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="mail_port">Mail Port</label>
                                                        <input type="text" name="mail_port"
                                                            value="{{ $smtp->mail_port }}" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="mail_encryption">Mail Encryption</label>
                                                        <select name="mail_encryption" class="form-control">
                                                            <option value="tls"
                                                                {{ $smtp->mail_encryption == 'tls' ? 'selected' : '' }}>TLS
                                                            </option>
                                                            <option value="ssl"
                                                                {{ $smtp->mail_encryption == 'ssl' ? 'selected' : '' }}>SSL
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-success">Update</button>
                                        </form>

                                    </div>
                                    <div class="tab-pane fade" id="email_template_tab" role="tabpanel">
                                        <div class="table-responsive table-invoice">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Email Template</th>
                                                        <th>Subject</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Password reset</td>
                                                        <td>Password Reset</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/1"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Contact mail</td>
                                                        <td>Contact Email</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/2"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Subscribe notification</td>
                                                        <td>Subscribe Notification</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/3"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>User verification</td>
                                                        <td>User Verification</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/4"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Approved refund</td>
                                                        <td>Refund Request Approval</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/5"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>New refund</td>
                                                        <td>New Refund Request</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/6"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>Pending wallet payment</td>
                                                        <td>Wallet Payment Approval</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/7"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>8</td>
                                                        <td>Approved withdraw</td>
                                                        <td>Withdraw Request Approval</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/8"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>9</td>
                                                        <td>Rejected withdraw</td>
                                                        <td>Withdraw Request Rejected</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/9"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>10</td>
                                                        <td>Pending withdraw</td>
                                                        <td>Withdraw Request Pending</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/10"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>11</td>
                                                        <td>Instructor request approved</td>
                                                        <td>Instructor Request Approval</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/11"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>12</td>
                                                        <td>Instructor request rejected</td>
                                                        <td>Instructor Request Rejected</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/12"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>13</td>
                                                        <td>Instructor request pending</td>
                                                        <td>Instructor Request is waiting for approval</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/13"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>14</td>
                                                        <td>Instructor quick contact</td>
                                                        <td>Mail for instructor contact form</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/14"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>15</td>
                                                        <td>Order completed</td>
                                                        <td>Your order has been placed</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/15"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>16</td>
                                                        <td>Qna reply mail</td>
                                                        <td>QNA Replay mail</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/16"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>17</td>
                                                        <td>Live class mail</td>
                                                        <td>Live class notification mail</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/17"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>18</td>
                                                        <td>Payment status</td>
                                                        <td>Update Payment Status</td>
                                                        <td>
                                                            <a href="http://rashidchachu.test/admin/edit-email-template/18"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!--Message Time-->
    <script>
        // Hide the alert messages after 5 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert-message').forEach(function(alert) {
                alert.style.transition = "opacity 0.5s";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500); // Remove after fade-out
            });
        }, 5000);
    </script>
@endsection

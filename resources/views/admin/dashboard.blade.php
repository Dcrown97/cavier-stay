@extends('layout.new')
@section('contents')
    <div class="row">
        <div class="col-md-8">
            @include('flash.flash')
            <h2>Welcome !</h2>
            <p>
                This is your Administration Area from which you can manage content on your website. Use the Menu to
                navigate
                through contents that you can manage.
            </p>
            <ul class="ul-course">
                {{-- @dd(Auth::user()) --}}
                <li><span>You are logged in as</span>: {{ Auth::user()->name ?? '' }}</li>
                <li><span>Last login</span>:
                    {{ Illuminate\Support\Carbon::parse(Auth::user()->last_login_at)->format('d/m/y') ?? '-' }} (
                    {{ Illuminate\Support\Carbon::parse(Auth::user()->last_login_at)->diffForHumans() ?? '-' }} )
                </li>
                <li><span>Login at </span>: {{ Auth::user()->last_login_ip ?? '' }}</li>
            </ul>
            <h3>Quick Links</h3>
            <div class="row">
                <ul class="ul-course">
                    <li><a href="/admin/locations">Locations</a></li>
                    <li><a href="/admin/property/types">Property Types</a></li>
                    <li><a href="/admin/properties">Properties</a></li>
                    <li><a href="/admin/property/agents">Property Agent</a></li>
                    <li><a href="/admin/contacts">Contacts</a></li>
                    <li><a href="/admin/testimonials">Testimonials</a></li>
                    <li><a href="/admin/transactions">Transactions</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4" style="margin-top: 10px">
            <p class="text-primary">Admin Registration is
                <span
                    class="{{ isset($allow_reg) && $allow_reg->allow_reg == 'Yes' ? 'text-success h3' : 'text-danger h3' }}">{{ isset($allow_reg) && $allow_reg->allow_reg == 'Yes' ? 'ON' : 'OFF' }}</span>
                | <small>(Last
                    modified by
                    {{ $allow_reg->user->name ?? '' }})</small>
            </p>

            <div class="row mx-3">
                <small>Admin Registration link</small>
                <input type="text" class="form-control" id="copyTarget" value="{{ url('/admin/register') }}">
                <button class="btn btn-primary" id="copyButton">Copy</button>
            </div><br><br>

            <form class="mx-3" action="/admin/allow_reg" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $allow_reg->id ?? '' }}">
                <div class="form-group">
                    <label for="inputEmail">Allow Admin Registration</label>
                    <select class="form-control" name="allow_reg" required>
                        <option value="">Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script src="/assets2/js/lib/jquery.min.js"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            document.getElementById("copyButton").addEventListener("click", function() {
                copyToClipboard(document.getElementById("copyTarget")).value;
            });
        });

        function copyToClipboard(elem) {
            // create hidden text element, if it doesn't already exist
            var targetId = "_hiddenCopyText_";
            var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
            var origSelectionStart, origSelectionEnd;
            if (isInput) {
                // can just use the original source element for the selection and copy
                target = elem;
                origSelectionStart = elem.selectionStart;
                origSelectionEnd = elem.selectionEnd;
            } else {
                // must use a temporary form element for the selection and copy
                target = document.getElementById(targetId);
                if (!target) {
                    var target = document.createElement("textarea");
                    target.style.position = "absolute";
                    target.style.left = "-9999px";
                    target.style.top = "0";
                    target.id = targetId;
                    document.body.appendChild(target);
                }
                target.textContent = elem.textContent;
            }
            // select the content
            var currentFocus = document.activeElement;
            target.focus();
            target.setSelectionRange(0, target.value.length);

            // copy the selection
            var succeed;
            try {
                succeed = document.execCommand("copy");
                Swal.fire({
                    title: 'Link Copied',
                    text: 'Warning ! Anyone registered through this link will have access to this admin panel',
                    icon: 'success',
                    color: 'red',
                    confirmButtonText: 'OK'
                });

            } catch (e) {
                succeed = false;
            }
            // restore original focus
            if (currentFocus && typeof currentFocus.focus === "function") {
                currentFocus.focus();
            }

            if (isInput) {
                // restore prior selection
                elem.setSelectionRange(origSelectionStart, origSelectionEnd);
            } else {
                // clear temporary content
                target.textContent = "";
            }
            return succeed;
        }
    </script>
@endsection

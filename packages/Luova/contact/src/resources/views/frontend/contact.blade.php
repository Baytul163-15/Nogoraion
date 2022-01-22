<div class="notice-title section-title">

    <h2>Contact US</h2>




</div>

<div class="contact-form">
    @if(count($errors) > 0)
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="navigation"></div>

    <div role="form" class="wpcf7" id="wpcf7-f420-p1369-o1" lang="en-US" dir="ltr">
        <div class="screen-reader-response"></div>
        {{Form::open(['route' => 'contact.store', 'method' => 'post'])}}
        <div class="single-contact">
            {{ Form::select('to_mail',ToMailList(), null,
                ['class' => 'form-control', 'placeholder' => '-- Select --']) }}
        </div>

        <div class="single-contact">

            <input type="text" name="name" value="" placeholder="name">

        </div>
        <div class="single-contact">
            <input type="email" name="email" value="" placeholder="Email">

        </div>
        <div class="single-contact">
            <input type="text" name="subject" value="" placeholder="Subject">

        </div>


        <div class="input-text-area">
            <textarea name="message" cols="40" rows="10" placeholder="Message"></textarea>

        </div>
        <div class="contact-btn">
            <input type="submit" value="Send">
        </div>

        {{ Form::close() }}

    </div>

</div>
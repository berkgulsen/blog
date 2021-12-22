@extends('front.layouts.master')
@section('title','İletişim ')
@section('bg')
@section('content')

    <div class="col-md-9  mx-auto">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
            @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <p>Bizimle iletişime geçebilirsiniz</p>
        <div class="my-5">
            <form method="POST" action="{{route('contact.post')}}">
                @csrf
                <div class="form mb-3">
                    <label for="name">Ad Soyad</label>
                    <input class="form-control" name="name" value="{{old('name')}}" type="text" placeholder="Adınızı soyadınızı giriniz..." />
                    <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                </div>
                <div class="form mb-3">
                    <label for="email">Mail Adresi</label>
                    <input class="form-control" name="email" value="{{old('email')}}" type="email" placeholder="Mail adresinizi giriniz..." />
                    <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                    <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                </div>
                <div class="form mb-3">
                    <label>Konu</label>
                    <select class="form-control" name="topic">
                        <option @if(old('topic')=="Bilgi") selected @endif>Bilgi</option>
                        <option @if(old('topic')=="Destek") selected @endif>Destek</option>
                        <option @if(old('topic')=="Genel") selected @endif>Genel</option>
                    </select>

                </div>
                <div class="form mb-3">
                    <label for="message">Mesajınız</label>
                    <textarea class="form-control" name="message" placeholder="Mesajınızı giriniz..." style="height: 12rem" >{{old('message')}}</textarea>
                    <div class="invalid-feedback" >A message is required.</div>
                </div>
                <br />

                <!-- Submit error message-->
                <!---->
                <!-- This is what your users will see when there is-->
                <!-- an error submitting the form-->
                <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                <!-- Submit Button-->
                <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Gönder</button>
            </form>
        </div>
    </div>
@endsection


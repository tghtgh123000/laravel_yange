<!DOCTYPE html>
<html>

@extends('admin.layouts.head')

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">IN+</h1>

        </div>
        <h3>欢迎登录颜格视觉管理后台</h3>
        <p>
        </p>
        <p>Login in. To see it in action.</p>
        <form class="m-t" role="form">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" placeholder="username" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="password" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
{{--
            <a href="#"><small>Forgot password?</small></a>
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>--}}
        </form>
        <p class="m-t"> <small>Base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>

@extends('layouts.template')

@section('title', 'Vérifiez votre adresse email')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vérifiez votre adresse email') }}</div>

                <div class="card-body">
                    <p class="text-sm text-gray-600">
                        {{ __('Merci de vous être inscrit ! Avant de commencer, pourriez-vous vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer par email ? Si vous n\'avez pas reçu l\'email, nous vous en enverrons volontiers un autre.') }}
                    </p>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success text-sm">
                            {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse email que vous avez fournie lors de l\'inscription.') }}
                        </div>
                    @endif

                    <div class="mt-4 flex items-center justify-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                {{ __('Renvoyer l\'email de vérification') }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link text-sm text-gray-600 hover:text-gray-900">
                                {{ __('Se déconnecter') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

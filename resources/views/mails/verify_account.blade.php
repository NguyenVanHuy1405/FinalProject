<div style="width:600px; margin: 0 auto">
  <div style="text-align:center">
    <h2>Hello {{$user->name}}</h2>
    <p>You have registered an account in our system</p>
    <p>To be able to continue using the services, please confirm your account.</p>
    <p>
        <a href="{{route('customer.activeAccount',['user' => $user->id,'token' => $user->token])}}" style="display:inline-block; background: green; color: #fff; padding: 7px 25px; font-weight:bold">Active Account</a> 
    </p>
</div>
</div>  

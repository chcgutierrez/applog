<?php
    class UserController extends Controller{
        public function collection(){
            $users = User::all();
            $response = [
                "data" => $users
            ];
            return $response;
        }
        public function store($user){
            try{
                validate(User::class, $user);
                $new_user = new User();
                $new_user->user_email = $user->user_email;
                $new_user->user_password = $user->user_password;
                $new_user->role_id = $user->role_id;
                $new_user->save();
                $response = [
                    "message" => "inserted succesfully"
                ];
                return response($response);
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
        public function show($id){
            $user = new User(User::find($id));
            return $user;
        }
        public function update($id, $new_user){
            try{
                validate(User::class, $new_user);
                $user = new User(User::find($id));
                if(!empty($user)){
                    $user->user_email = $new_user->user_email;
                    $user->user_password = $new_user->user_password;
                    $user->role_id = $new_user->role_id;
                    $user->save();
                    $response = [
                        "message" => "updated succesfully"
                    ];
                    return response($response);
                }else{
                    echo "User not found";
                }
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
        public function destroy($id){
            $user = new User(User::find($id));
            if(!empty($user)){
                if($user->delete()){
                    $response = [
                        "message" => "deleted succesfully"
                    ];
                    return response($response);
                }
            }else{
                echo "User not found";
            }
        }
    }
?>
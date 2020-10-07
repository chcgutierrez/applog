<?php
    class RoleController extends Controller{
        public function collection(){
            $roles = Role::all();
            $response = [
                "data" => $roles
            ];
            return $response;
        }
        public function store($role){
            try{
                validate(Role::class, $role);
                $new_role = new Role();
                $new_role->role_name = $role->role_name;
                $new_role->save();
                $response = [
                    "message" => "inserted succesfully"
                ];
                return response($response);
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
        public function show($id){
            $role = new Role(Role::find($id));
            return $role;
        }
        public function update($id, $new_role){
            try{
                validate(Role::class, $new_role);
                $role = new Role(Role::find($id));
                if(!empty($role)){
                    $role->role_name = $new_role->role_name;
                    $role->save();
                    $response = [
                        "message" => "updated succesfully"
                    ];
                    return response($response);
                }else{
                    echo "role not found";
                }
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
        public function destroy($id){
            $role = new Role(Role::find($id));
            if(!empty($role)){
                if($role->delete()){
                    $response = [
                        "message" => "deleted succesfully"
                    ];
                    return response($response);
                }
            }else{
                echo "Role not found";
            }
        }
    }
?>
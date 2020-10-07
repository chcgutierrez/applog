<?php
    class StatusController extends Controller{
        public function collection(){
            $status = Status::all();
            $response = [
                "data" => $status
            ];
            return $response;
        }
        public function store($status){
            try{
                validate(Status::class, $status);
                $new_status = new Status();
                $new_status->status_name = $status->status_name;
                $new_status->save();
                $response = [
                    "message" => "inserted succesfully"
                ];
                return response($response);
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
        public function show($id){
            $status = new Status(Status::find($id));
            return $status;
        }
        public function update($id, $new_status){
            try{
                validate(Status::class, $new_status);
                $status = new Status(Status::find($id));
                if(!empty($status)){
                    $status->status_name = $new_status->status_name;
                    $status->save();
                    $response = [
                        "message" => "updated succesfully"
                    ];
                    return response($response);
                }else{
                    echo "status not found";
                }
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
        public function destroy($id){
            $status = new Status(Status::find($id));
            if(!empty($status)){
                if($status->delete()){
                    $response = [
                        "message" => "deleted succesfully"
                    ];
                    return response($response);
                }
            }else{
                echo "Status not found";
            }
        }
    }
?>
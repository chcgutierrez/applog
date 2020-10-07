<?php
    class BacklogController extends Controller{
        public function collection(){
            $backlogs = Backlog::all();
            $response = [
                "data" => $backlogs
            ];
            return $response;
        }
        public function store($backlog){
            try{
                validate(Backlog::class, $backlog);
                $new_backlog = new Backlog();
                $new_backlog->backlog_name = $backlog->backlog_name;
                $new_backlog->user_id = $backlog->user_id;
                $new_backlog->save();
                $response = [
                    "message" => "inserted succesfully"
                ];
                return response($response);
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
        public function show($id){
            $backlog = new Backlog(Backlog::find($id));
            return $backlog;
        }
        public function update($id, $new_backlog){
            try{
                validate(Backlog::class, $new_backlog);
                $backlog = new Backlog(Backlog::find($id));
                if(!empty($backlog)){
                    $backlog->backlog_name = $new_backlog->backlog_name;
                    $backlog->user_id = $new_backlog->user_id;
                    $backlog->save();
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
            $backlog = new Backlog(Backlog::find($id));
            if(!empty($backlog)){
                if($backlog->delete()){
                    $response = [
                        "message" => "deleted succesfully"
                    ];
                    return response($response);
                }
            }else{
                echo "Backlog not found";
            }
        }
    }
?>
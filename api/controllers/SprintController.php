<?php
    class SprintController extends Controller{
        public function collection(){
            $sprints = Sprint::all();
            $response = [
                "data" => $sprints
            ];
            return $response;
        }
        public function store($sprint){
            try{
                validate(Sprint::class, $sprint);
                $new_sprint = new Sprint();
                $new_sprint->sprint_goal = $sprint->sprint_goal;
                $new_sprint->sprint_time = $sprint->sprint_time;
                $new_sprint->sprint_start_date = $sprint->sprint_start_date;
                $new_sprint->sprint_end_date = $sprint->sprint_end_date;
                $new_sprint->backlog_id = $sprint->backlog_id;
                $new_sprint->save();
                $response = [
                    "message" => "inserted succesfully"
                ];
                return response($response);
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
        public function show($id){
            $sprint = new Sprint(Sprint::find($id));
            return $sprint;
        }
        public function update($id, $new_sprint){
            try{
                validate(Sprint::class, $new_sprint);
                $sprint = new Sprint(Sprint::find($id));
                if(!empty($sprint)){
                    $sprint->sprint_goal = $new_sprint->sprint_goal;
                    $sprint->sprint_time = $new_sprint->sprint_time;
                    $sprint->sprint_start_date = $new_sprint->sprint_start_date;
                    $sprint->sprint_end_date = $new_sprint->sprint_end_date;
                    $sprint->backlog_id = $new_sprint->backlog_id;
                    $sprint->save();
                    $response = [
                        "message" => "updated succesfully"
                    ];
                    return response($response);
                }else{
                    echo "sprint not found";
                }
            }catch(Exception $error){
                echo $error->getMessage();
            }
        }
        public function destroy($id){
            $sprint = new Sprint(Sprint::find($id));
            if(!empty($sprint)){
                if($sprint->delete()){
                    $response = [
                        "message" => "deleted succesfully"
                    ];
                    return response($response);
                }
            }else{
                echo "Sprint not found";
            }
        }
    }
?>
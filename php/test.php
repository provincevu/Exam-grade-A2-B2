                <div class="projects bg-projects" id='project_content'>
                    <div class="project-status">
                        <div class="status">
                            <b id="is_comming">Is comming</b>
                        </div>
                        <div class="status">
                            <b id="to_do">to do</b>
                        </div>
                        <div class="status">
                            <b id="completed">completed</b>
                        </div>
                    </div>
                    <div class="project-list">
                        <?php
                            $moment = date('Y-m-d');
                            $select_du_an = $connect->query("SELECT *, HOUR(du_an.ngay_khoi_tao) AS hour,MINUTE(du_an.ngay_khoi_tao) AS minute FROM `du_an`");
                            while($du_an = $select_du_an->fetch_assoc()){
                                echo "
                                <div class='project-info' id=";
                                if ($du_an['ngay_bat_dau'] > $moment){
                                    echo 'project_is_comming';
                                }
                                elseif($du_an['ngay_ket_thuc'] >= $moment){
                                    echo 'project_to_do';
                                }
                                else{
                                    echo 'project_completed';
                                }
                                echo ">
                                    <div class='start-day mt-3'>
                                        <b>". $du_an['ngay_bat_dau'] ."</b>
                                    </div>
                                    <div class='project-name' id='project_name'>
                                        <p style='display: none' id='id_du_an'>". $du_an['id_du_an'] ."</p>
                                        <h4>". $du_an['ten_du_an'] ."</h4>
                                        <p>submitted at ". $du_an['hour'] .":". $du_an['minute'] ."</p>
                                    </div>
                                </div>
                                ";
                            }
                        ?>
                    </div>
                </div>
                <div class='project-detail' id='project_detail'>
                    <!-- chỗ để dự án hiển thị -->
                </div>
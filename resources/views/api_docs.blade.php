@extends('bootstrap')

@section('jumbotron')
<h1>Exceed 2018 API Documentation</h1>
<p>เอกสารในหน้านี้บ่งบอกทาง (route) ไปยัง API สำหรับตัวเก็บข้อมูล, ลักษณะการเรียกขอค่า และลักษณะการส่งคืน</p>
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
        <h1>ลักษณะของ API</h1>
        <p>API ที่มีให้เป็นลักษณะของ key-value pair หากกล่าวโดยละเอียด ลักษณะการทำงานเหมือนกับโครงสร้างข้อมูล <code>dict</code> ในภาษาไพธอน</p>
        <p><b>เนื่องจากชื่อตัวแปรไม่ควรจะตีกัน ขอความร่วมมือให้ทุกกลุ่มใส่ชื่อกลุ่มตัวเองไว้หน้าตัวแปรที่จะเก็บ คั่นกลางด้วย underscore</b></p>
        <p>เช่น หากกลุ่ม <code>srakrn</code> จะอ่านตัวแปร <code>temperature</code> อาจจะเรียกค่าได้ดังนี้</p>
        <pre><code>
    http://{{ $_SERVER['HTTP_HOST'] }}/api/srakrn_temperature/view
        </code></pre>

        <h1>เส้นทางที่มีให้ใช้</h1>

        <div class="card">
            <div class="card-body">
                <h3>เรียกดูค่าล่าสุดที่เคยบันทึก</h3>
                <p><span class="badge badge-secondary">GET</span> http://{{ $_SERVER['HTTP_HOST'] }}/api/{key}/view/</p>
                <h4>ลักษณะการส่งคืนข้อมูล</h4>
                <p>ส่งคืนเป็น plaintext เป็นค่าที่เคยบันทึกไว้ล่าสุด และจะส่งคืนค่าว่างหากไม่เคยมีการบันทึกค่านั้นมาก่อน<p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>เรียกดูประวัติการบันทึก</h3>
                <p><span class="badge badge-secondary">GET</span> http://{{ $_SERVER['HTTP_HOST'] }}/api/{key}/history/</p>
                <h4>ลักษณะการส่งคืนข้อมูล</h4>
                <p>ส่งคืนเป็นอาร์เรย์ของ JSON ซึ่งสำหรับสมาชิกทุกตัวในอาร์เรย์ จะเป็น JSON Object ประกอบด้วยฟิลด์ดังนี้<p>
                <ul>
                    <li><code>id</code>: เป็นเลขเฉพาะซึ่งจะไม่ซ้ำกันในข้อมูลทุกการบันทึก</li>
                    <li><code>value</code>: ค่าที่เคยบันทึกไว้</li>
                    <li><code>created_at</code>: เวลาที่เคยบันทึกค่านั้น</li>
                </ul>
                <p>กรณีไม่เคยบันทึกค่านั้นมาก่อน จะส่งคืนอาร์เรย์เปล่า</p>
                <div id="accordion">
                    <div class="card border-secondary">
                        <div class="card-header" id="headingOne">
                            รีเควสต์นี้สามารถเรียกพารามิเตอร์ได้เพิ่มเติม
                            <a href="#" class="btn btn-secondary" data-toggle="collapse" data-target="#view_additional_parameters">
                                คลิกดูเอกสารพารามิเตอร์เพิ่มเติม
                            </a>
                        </div>
                        <div id="view_additional_parameters" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>พารามิเตอร์</th>
                                            <th>ชนิดค่า</th>
                                            <th>คำอธิบาย</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td>before</td>
                                        <td>integer</td>
                                        <td>เรียกเฉพาะข้อมูลที่มีค่า id น้อยกว่าเลขที่ระบุ</td>
                                    </tr>
                                    <tr>
                                        <td>after</td>
                                        <td>integer</td>
                                        <td>เรียกเฉพาะข้อมูลที่มีค่า id มากกว่ากว่าเลขที่ระบุ</td>
                                    </tr>
                                    <tr>
                                        <td>limit</td>
                                        <td>integer</td>
                                        <td>กำหนดจำนวนข้อมูลมากที่สุดที่จะเรียก (สูงสุดไม่เกิน 100, หากไม่ระบุจะเท่ากับ 10)</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>บันทึกค่า</h3>
                <p><span class="badge badge-danger">POST</span> http://{{ $_SERVER['HTTP_HOST'] }}/api/{key}/set/</p>
                <p>เก็บค่าเข้าไว้ในฐานข้อมูล ซึ่งสามารถเรียกมาอ่านอีกครั้งได้ด้วย <code>key</code>ที่ระบุ</p>
                <p><b>สำหรับค่าที่จะเก็บ ให้ส่งเข้ามาในพารามิเตอร์ <code>value</code> ผ่านทางรีเควสต์</b></p>
                <h4>ลักษณะการส่งคืนข้อมูล</h4>
                <p>ส่งคืนเป็น JSON บ่งบอกสถานะการทำงาน ซึ่งฟิลด์ <code>status</code> เป็น <code>success</code> หรือ <code>error</code> ตามแต่สถานะการทำงาน<p>
            </div>
        </div>
    </div>
</div>
@endsection
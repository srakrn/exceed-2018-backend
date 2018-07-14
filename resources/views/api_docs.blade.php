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
        <p>เพื่อไม่ให้ค่าตีกัน ในการเรียกหรือเก็บค่าใดๆ จะต้องระบุคีย์ร่วมกันทั้งหมดสองตัว ได้แก่<p>
        <ul>
            <li>ชื่อกลุ่ม หรือเลขประจำกลุ่ม หรือค่าใดก็ได้<b>ที่มั่นใจว่าจะไม่ซ้ำระหว่างกลุ่ม</b> (เรียกว่า <code>key_1</code>)</li>
            <li>ชื่อตัวแปรที่ต้องการจะเก็บ (เรียกว่า <code>key_2</code>)</li>
        </ul>
        <p>เช่น หากกลุ่ม <code>best_exceed_group</code> จะอ่านตัวแปร <code>temperature</code> อาจจะเรียกค่าได้ดังนี้</p>
        <pre><code>
    http://{{ $_SERVER['HTTP_HOST'] }}/api/view/best_exceed_group/temperature/
        </code></pre>

        <h1>เส้นทางที่มีให้ใช้</h1>
        <div class="card">
            <div class="card-body">
                <h3>เรียกดูค่าทั้งหมดที่เคยบันทึก</h3>
                <p><span class="badge badge-secondary">GET</span> http://{{ $_SERVER['HTTP_HOST'] }}/api/view/{key_1}/{key_2}/</p>
                <h4>ลักษณะการส่งคืนข้อมูล</h4>
                <p>ส่งคืนเป็นอาร์เรย์ของ JSON ซึ่งสำหรับสมาชิกทุกตัวในอาร์เรย์ จะเป็น JSON Object ประกอบด้วยฟิลด์ดังนี้<p>
                <ul>
                    <li><code>id</code>: เป็นเลขเฉพาะซึ่งจะไม่ซ้ำกันในข้อมูลทุกการบันทึก</li>
                    <li><code>value</code>: ค่าที่เคยบันทึกไว้</li>
                    <li><code>created_at</code>: เวลาที่เคยบันทึกค่านั้น</li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>เรียกดูค่าล่าสุดที่เคยบันทึก</h3>
                <p><span class="badge badge-secondary">GET</span> http://{{ $_SERVER['HTTP_HOST'] }}/api/view/{key_1}/{key_2}/latest/</p>
                <h4>ลักษณะการส่งคืนข้อมูล</h4>
                <p>ส่งคืนเป็น JSON Object ประกอบด้วยฟิลด์ดังนี้<p>
                <ul>
                    <li><code>id</code>: เป็นเลขเฉพาะซึ่งจะไม่ซ้ำกันในข้อมูลทุกการบันทึก</li>
                    <li><code>value</code>: ค่าที่เคยบันทึกไว้</li>
                    <li><code>created_at</code>: เวลาที่เคยบันทึกค่านั้น</li>
                </ul>
                <p>กรณีไม่เคยบันทึกค่านั้นมาก่อน จะส่งคืน JSON Object ลักษณะดังด้านล่าง</p>
                <pre><code>
    {
        "status": "error",
        "message": "No values of this key has been stored before."
    }
                </pre></code>
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
                <h3>เรียกดูค่าล่าสุดที่เคยบันทึกในลักษณะ plaintext</h3>
                <p><span class="badge badge-secondary">GET</span> http://{{ $_SERVER['HTTP_HOST'] }}/api/view/{key_1}/{key_2}/latest/value/</p>
                <h4>ลักษณะการส่งคืนข้อมูล</h4>
                <p>ส่งคืนเป็น plaintext เป็นค่าที่เคยบันทึกไว้ล่าสุด และจะส่งคืนค่าว่างหากไม่เคยมีการบันทึกค่านั้นมาก่อน<p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>บันทึกค่า</h3>
                <p><span class="badge badge-danger">POST</span> http://{{ $_SERVER['HTTP_HOST'] }}/api/set/{key_1}/{key_2}/{value}/</p>
                <p>เก็บค่า <code>value</code> เข้าไว้ในฐานข้อมูล ซึ่งสามารถเรียกมาอ่านอีกครั้งได้ด้วย <code>key_1</code> และ <code>key_2</code> ที่ระบุ</p>
                <h4>ลักษณะการส่งคืนข้อมูล</h4>
                <p>ส่งคืนเป็น JSON บ่งบอกสถานะการทำงาน<p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>ดู key_2 ทั้งหมดที่เคยบันทึก</h3>
                <p><span class="badge badge-secondary">GET</span> http://{{ $_SERVER['HTTP_HOST'] }}/api/keys/{key_1}/</p>
                <p>เมื่อให้ <code>key_1</code> มา ดูว่าคีย์นั้นเคยบันทึกค่า <code>key_2</code> ใดไว้บ้าง</p>
                <h4>ลักษณะการส่งคืนข้อมูล</h4>
                <p>ส่งคืนเป็นอาร์เรย์ของค่า <code>key_2</code> ทั้งหมดที่พบ<p>
            </div>
        </div>
    </div>
</div>
@endsection
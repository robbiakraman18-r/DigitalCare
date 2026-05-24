<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Schedule</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#f5f7fb;
        }

        .container{
            display:flex;
            min-height:100vh;
        }

        /* SIDEBAR */

        .sidebar{
            width:90px;
            background:white;
            border-right:1px solid #d8e1e8;
            display:flex;
            flex-direction:column;
            align-items:center;
            padding:20px 0;
        }

        .logo{
            font-size:40px;
            color:#6ea5bb;
            margin-bottom:40px;
        }

        .menu{
            display:flex;
            flex-direction:column;
            gap:28px;
        }

        .menu i{
            font-size:24px;
            color:#111;
            cursor:pointer;
        }

        .active{
            background:#d9edf5;
            padding:14px;
            border-radius:50%;
        }

        .logout{
            margin-top:auto;
            margin-bottom:20px;
            color:#ff5a36;
            font-size:28px;
        }

        /* CONTENT */

        .content{
            flex:1;
        }

        .header{
            background:#76a7bc;
            padding:25px 35px;
            color:white;
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
        }

        .header h1{
            font-size:48px;
            font-weight:700;
        }

        .header p{
            font-size:20px;
            margin-top:5px;
        }

        .doctor-box{
            background:white;
            color:#111;
            padding:10px 18px;
            border-radius:30px;
            font-weight:600;
        }

        .main{
            padding:35px;
        }

        .card{
            background:white;
            border-radius:18px;
            padding:35px;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }

        .week{
            margin-bottom:25px;
        }

        .week h2{
            font-size:30px;
            margin-bottom:8px;
        }

        .next-btn{
            float:right;
            border:1px solid #ddd;
            background:white;
            padding:10px 22px;
            border-radius:12px;
            cursor:pointer;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:14px;
        }

        th{
            background:#f3f3f3;
            padding:18px;
            text-align:left;
            font-size:18px;
        }

        td{
            padding:18px;
            border-top:1px solid #ececec;
            font-size:17px;
        }

        .status{
            background:#d9f0df;
            color:#2d7d46;
            padding:7px 16px;
            border-radius:10px;
            font-weight:600;
        }

        .info{
            margin-top:30px;
            background:#d9ecff;
            padding:18px;
            border-radius:14px;
            text-align:center;
            color:#225a9e;
            font-weight:500;
        }

        @media(max-width:768px){

            .sidebar{
                display:none;
            }

            .header{
                flex-direction:column;
                gap:20px;
            }

            .header h1{
                font-size:35px;
            }

            table{
                font-size:14px;
            }

            th,td{
                padding:12px;
            }

        }

    </style>

</head>
<body>

<div class="container">

    <!-- SIDEBAR -->

    <div class="sidebar">

        <div class="logo">
            <i class="fa-regular fa-heart"></i>
        </div>

        <div class="menu">

            <i class="fa-solid fa-house"></i>

            <div class="active">
                <i class="fa-regular fa-calendar"></i>
            </div>

            <i class="fa-solid fa-calendar-days"></i>

            <i class="fa-solid fa-briefcase-medical"></i>

            <i class="fa-solid fa-user"></i>

            <i class="fa-solid fa-circle-info"></i>

        </div>

        <div class="logout">
            <i class="fa-solid fa-right-from-bracket"></i>
        </div>

    </div>

    <!-- CONTENT -->

    <div class="content">

        <div class="header">

            <div>
                <h1>Practice Schedule</h1>
                <p>Your practice schedule and availability.</p>
            </div>

            <div class="doctor-box">
                <i class="fa-solid fa-user-doctor"></i>
                Dr. Supardi Natsir
            </div>

        </div>

        <div class="main">

            <div class="card">

                <div class="week">
                    <h2>This Week</h2>
                    <p>20 - 24 May 2026</p>
                </div>

                <button class="next-btn">
                    Next Week →
                </button>

                <table>

                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Date</th>
                            <th>Practice Time</th>
                            <th>Quota</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>Monday</td>
                            <td>20 May 2026</td>
                            <td>08.00 - 16.00</td>
                            <td>20 Patients</td>
                            <td>
                                <span class="status">
                                    Active
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>Tuesday</td>
                            <td>21 May 2026</td>
                            <td>08.00 - 16.00</td>
                            <td>20 Patients</td>
                            <td>
                                <span class="status">
                                    Active
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>Wednesday</td>
                            <td>22 May 2026</td>
                            <td>08.00 - 16.00</td>
                            <td>20 Patients</td>
                            <td>
                                <span class="status">
                                    Active
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>Thursday</td>
                            <td>23 May 2026</td>
                            <td>08.00 - 16.00</td>
                            <td>20 Patients</td>
                            <td>
                                <span class="status">
                                    Active
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>Friday</td>
                            <td>24 May 2026</td>
                            <td>08.00 - 16.00</td>
                            <td>20 Patients</td>
                            <td>
                                <span class="status">
                                    Active
                                </span>
                            </td>
                        </tr>

                    </tbody>

                </table>

                <div class="info">
                    <i class="fa-solid fa-circle-info"></i>
                    Schedule may change according to clinic needs
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
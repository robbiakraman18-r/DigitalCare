<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
            background:#f3f5f9;
        }

        .main{
            display:flex;
            min-height:100vh;
        }

        /* SIDEBAR */
        .sidebar{
            width:90px;
            background:white;
            border-right:1px solid #dbe4ea;
            display:flex;
            flex-direction:column;
            align-items:center;
            padding:20px 0;
            gap:30px;
        }

        .logo{
            font-size:35px;
            color:#5f9db7;
            font-weight:bold;
        }

        .menu{
            display:flex;
            flex-direction:column;
            gap:25px;
            margin-top:20px;
        }

        .menu i{
            font-size:24px;
            color:#111;
            cursor:pointer;
        }

        .logout{
            margin-top:auto;
            margin-bottom:20px;
            color:#ff5b2e;
            font-size:24px;
        }

        /* CONTENT */
        .content{
            flex:1;
            padding:25px;
        }

        .topbar{
            background:#79a9bf;
            padding:25px;
            border-radius:0 0 10px 10px;
            color:white;
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
        }

        .topbar h1{
            font-size:42px;
        }

        .topbar p{
            margin-top:5px;
            font-size:20px;
        }

        .doctor-box{
            background:white;
            color:#111;
            padding:10px 18px;
            border-radius:30px;
            font-weight:600;
        }

        .card{
            background:white;
            margin-top:-10px;
            padding:25px;
            border-radius:15px;
            box-shadow:0 3px 10px rgba(0,0,0,0.05);
        }

        .filter{
            display:flex;
            justify-content:space-between;
            margin-bottom:25px;
            flex-wrap:wrap;
            gap:15px;
        }

        .search-box input{
            width:320px;
            padding:12px 15px;
            border:1px solid #ddd;
            border-radius:12px;
            outline:none;
        }

        .status-select,
        .date-btn{
            padding:12px 18px;
            border:1px solid #ddd;
            border-radius:12px;
            background:white;
            cursor:pointer;
        }

        table{
            width:100%;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:12px;
        }

        th{
            background:#f7f7f7;
            padding:16px;
            text-align:left;
            color:#333;
        }

        td{
            padding:16px;
            border-top:1px solid #eee;
        }

        .status{
            padding:8px 14px;
            border-radius:10px;
            font-size:14px;
            font-weight:600;
            display:inline-block;
        }

        .done{
            background:#d7f2df;
            color:#2c7a4b;
        }

        .waiting{
            background:#fce9c9;
            color:#a36b00;
        }

        .cancel{
            background:#ffd6d6;
            color:#c0392b;
        }

        .detail-btn{
            border:1px solid #5fa8ff;
            color:#3490ff;
            background:white;
            padding:8px 18px;
            border-radius:10px;
            cursor:pointer;
        }

        .view-all{
            margin-top:25px;
            background:#d9ecff;
            padding:15px;
            text-align:center;
            border-radius:12px;
            color:#1f5c99;
            font-weight:600;
            cursor:pointer;
        }

        @media(max-width:768px){

            .sidebar{
                display:none;
            }

            .topbar{
                flex-direction:column;
                gap:20px;
            }

            .topbar h1{
                font-size:32px;
            }

            .search-box input{
                width:100%;
            }

            table{
                font-size:14px;
            }

            th,td{
                padding:10px;
            }
        }
    </style>

    <!-- ICON -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body>

<div class="main">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="logo">
            <i class="fa-regular fa-heart"></i>
        </div>

        <div class="menu">
            <i class="fa-solid fa-house"></i>
            <i class="fa-regular fa-calendar"></i>
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

        <!-- HEADER -->
        <div class="topbar">

            <div>
                <h1>Appointments</h1>
                <p>Patient appointment schedule.</p>
            </div>

            <div class="doctor-box">
                <i class="fa-solid fa-user-doctor"></i>
                Dr. Supardi Natsir
            </div>

        </div>

        <!-- TABLE CARD -->
        <div class="card">

            <!-- FILTER -->
            <div class="filter">

                <div class="search-box">
                    <input type="text"
                    placeholder="Search patient name, complaint">
                </div>

                <button class="date-btn">
                    Today
                </button>

                <select class="status-select">
                    <option>All Status</option>
                    <option>Completed</option>
                    <option>Waiting</option>
                    <option>Cancelled</option>
                </select>

            </div>

            <!-- TABLE -->
            <table>

                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Patient</th>
                        <th>Complaint</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($schedules as $schedule)
                    <tr>

                        <td>{{ $schedule->start_time }}</td>

                        <td>{{ $schedule->doctor_name }}</td>

                        <td>Fever</td>

                        <td>Consultation</td>

                        <td>
                            <span class="status done">
                                Completed
                            </span>
                        </td>

                        <td>
                            <button class="detail-btn">
                                Detail
                            </button>
                        </td>

                    </tr>
                    @empty

                    <tr>
                        <td colspan="6" style="text-align:center; padding:30px; color:gray;">
                            No appointments available
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="view-all">
                <i class="fa-solid fa-circle-info"></i>
                View all appointments
            </div>

        </div>

    </div>

</div>

</body>
</html> 
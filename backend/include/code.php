<?php
session_start();
include('database.php');
include('functions.php');

/*------------------------------------ Login -------------------------------------*/

if (isset($_POST['login'])) {
    $email = strip_tags(mysqli_real_escape_string($conn, $_POST['email']));
    $password = strip_tags(mysqli_real_escape_string($conn, $_POST['password']));
    $error = '';
    if (empty($email)) {
        $error = 'Please enter your email !!';
    }
    // else if (empty($password)) {
    //     $error = 'Please enter your password !!';
    // }
    else {
        $sql = "SELECT * FROM `employee` WHERE `email`='$email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                // if ($password == $row['password']) { 
                if (password_verify($password, $row['password'])) {
                    $_SESSION['isLogin'] = true;
                    $_SESSION['emplID'] = $row['id'];
                    $employeeId = $row['id'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['phone'] = $row['phone'];
                    $_SESSION['gender'] = $row['gender'];
                    $_SESSION['address'] = $row['address'];
                    $_SESSION['employeeType'] = $row['employeeType'];
                    $_SESSION['salaryType'] = $row['salaryType'];
                    $_SESSION['image'] = $row['image'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['date'] = date("Y-m-d", strtotime($row['date']));


                    $previous_id = random_int(1000, 9000);
                    $previous_date = date('Y-m-d', strtotime('-1 day'));
                    $previous_day = date('l', strtotime($previous_date));
                    $previous_year =  date('Y', strtotime($previous_date));
                    $previous_month =  date('F', strtotime($previous_date));
                    $previous_day =  date('d', strtotime($previous_date));
                    $previous_days =  date('l', strtotime($previous_date));

                    $previousDayAttendance = "SELECT * FROM `attendance` WHERE `date`='$previous_date'";
                    $selectPreviousDay = mysqli_query($conn, $previousDayAttendance);



                    $id = random_int(1000, 9000);
                    if ($id == $previous_id) {
                        $id = random_int(1000, 9000);
                    }
                    $date = date('Y-m-d');
                    $year =  date('Y', strtotime($date));
                    $month =  date('F', strtotime($date));
                    $day =  date('d', strtotime($date));
                    $days =  date('l', strtotime($date));

                    $selectTodayAttendance = "SELECT * FROM `attendance` WHERE `employeeId` = '$employeeId' AND `date`='$date'";
                    $select = mysqli_query($conn, $selectTodayAttendance);
                    $rowww = mysqli_fetch_assoc($select);
                    if (mysqli_num_rows($select) == 0) {
                        // if ((mysqli_num_rows($selectPreviousDay) == 0)) {
                        if ((mysqli_num_rows($selectPreviousDay) == 0) && $previous_days != 'Saturday') {
                            $attendanceQry = "INSERT INTO `attendance`(`id`, `employeeId`, `year`, `month`, `day`, `days`,`status`, `date`) VALUES (' $previous_id','$employeeId','$previous_year','$previous_month','$previous_day','$previous_days', 0,'$previous_date')";
                            $markAttendance = mysqli_query($conn, $attendanceQry);
                        }
                        $attendanceQry = "INSERT INTO `attendance`(`id`, `employeeId`, `year`, `month`, `day`, `days`,`status`, `date`) VALUES ('$id','$employeeId','$year','$month','$day','$days', 1 ,'$date')";
                        $markAttendance = mysqli_query($conn, $attendanceQry);
                        echo $attendanceQry;
                        print_r($markAttendance);
                    }


                    echo "<script>window.location.href = '../../frontend/dashboard.php';</script>";
                } else {
                    $error = 'Please enter valid password !!';
                }
            }
        } else {
            $error = 'Please enter valid email !!';
        }
    }
    if (!empty($error)) {
        $status = $error;
        $title = 'Error';
        $icon = 'error';
        $path = '<script> window.history.back(); </script>';
        alertBox($status, $title, $icon, $path);
    }
}

/*------------------------------------ Salary Type --------------------------------*/

if (isset($_POST['addSalaryType'])) {
    $salaryType = mysqli_real_escape_string($conn, $_POST['salaryType']);
    if (empty($salaryType)) {
        $error = 'All fields are required';
    } else {
        $select = mysqli_query($conn, "SELECT * FROM `salarytype` WHERE `salaryType` = '$salaryType'");
        $num = mysqli_num_rows($select);
        if ($num > 0) {
            $error = 'Data already exist';
        } else {
            $id = random_int(1000, 9000);
            $sql = "INSERT INTO `salarytype`(`id`, `salaryType`) VALUES ('$id', '$salaryType')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $status = 'Data added successfully';
                $title = 'Success';
                $icon = 'success';
                $path = '<script> window.location.href = "http://localhost/salaryMS/frontend/addSalaryType.php"; </script>';
                alertBox($status, $title, $icon, $path);
            } else {
                $error = 'Data not added';
            }
        }
    }
    if (!empty($error)) {
        $status = $error;
        $title = 'Error';
        $icon = 'error';
        $path = '<script> window.history.back(); </script>';
        alertBox($status, $title, $icon, $path);
    }
}

/*------------------------------------ Salary -------------------------------------*/

if (isset($_POST['addSalary'])) {
    $salaryType = mysqli_real_escape_string($conn, $_POST['salaryType']);
    $salaryAmount = mysqli_real_escape_string($conn, $_POST['salaryAmount']);
    if (empty($salaryType) || empty($salaryAmount)) {
        $error = 'All fields are required';
    } else {
        $select = mysqli_query($conn, "SELECT * FROM `salary` WHERE `SalaryTypeId` = '$salaryType'");
        $num = mysqli_num_rows($select);
        if ($num > 0) {
            $error = 'Data already exist';
        } else {
            $id = random_int(1000, 9000);
            $sql = "INSERT INTO `salary`(`id`, `SalaryTypeId`,`amount`) VALUES ('$id', '$salaryType', '$salaryAmount')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $status = 'Data added successfully';
                $title = 'Success';
                $icon = 'success';
                $path = '<script> window.location.href = "http://localhost/salaryMS/frontend/addSalary.php"; </script>';
                alertBox($status, $title, $icon, $path);
            } else {
                $error = 'Data not added';
            }
        }
    }
    if (!empty($error)) {
        $status = $error;
        $title = 'Error';
        $icon = 'error';
        $path = '<script> window.history.back(); </script>';
        alertBox($status, $title, $icon, $path);
    }
}

if (isset($_POST['editSalary'])) {
    $salaryType = mysqli_real_escape_string($conn, $_POST['salaryType']);
    $salaryAmount = mysqli_real_escape_string($conn, $_POST['salaryAmount']);
    $editid = mysqli_real_escape_string($conn, $_POST['editid']);
    if (empty($salaryType) || empty($salaryAmount)) {
        $error = 'All fields are required';
    } else {
        $sql = "UPDATE `salary` 
                SET 
                `SalaryTypeId` = '$salaryType',
                `amount` = '$salaryAmount'
                WHERE `id` = '$editid'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $status = 'Data updated successfully';
            $title = 'Success';
            $icon = 'success';
            $path = '<script> window.location.href = "http://localhost/salaryMS/frontend/salaryTypeList.php" </script>';
            alertBox($status, $title, $icon, $path);
        } else {
            $error = 'Data not updated';
        }
    }
    if (!empty($error)) {
        $status = $error;
        $title = 'Error';
        $icon = 'error';
        $path = '<script> window.history.back(); </script>';
        alertBox($status, $title, $icon, $path);
    }
}

if (isset($_GET['deleteSalary'])) {
    $deleteSalary = $_GET['deleteSalary'];

    $sql = "DELETE FROM `salary` WHERE `id` = '$deleteSalary'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $status = 'Data deleted successfully';
        $title = 'Success';
        $icon = 'success';
        $path = '<script> window.history.back(); </script>';
        alertBox($status, $title, $icon, $path);
    } else {
        $status = 'Data not deleted';
        $title = 'Error';
        $icon = 'error';
        $path = '<script> window.history.back(); </script>';
        alertBox($status, $title, $icon, $path);
    }
}

/*------------------------------------ Employee Type ------------------------------*/

if (isset($_POST['addEmployeeType'])) {
    $employeeType = mysqli_real_escape_string($conn, $_POST['employeeType']);
    if (empty($employeeType)) {
        $error = 'All fields are required';
        alertBox($status, $title, $icon, $path);
    } else {
        $select = mysqli_query($conn, "SELECT * FROM `employeeType` WHERE `employeeType` = '$employeeType'");
        $num = mysqli_num_rows($select);
        if ($num > 0) {
            $error = 'Data already exist';
            alertBox($status, $title, $icon, $path);
        } else {
            $id = random_int(1000, 9000);
            $sql = "INSERT INTO `employeetype`(`id`, `employeeType`) VALUES ('$id', '$employeeType')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $status = 'Data added successfully';
                $title = 'Success';
                $icon = 'success';
                $path = '<script> window.location.href = "http://localhost/salaryMS/frontend/addEmployeeType.php"; </script>';
                alertBox($status, $title, $icon, $path);
            } else {
                $error = 'Data not added';
            }
        }
    }
    if (!empty($error)) {
        $status = $error;
        $title = 'Error';
        $icon = 'error';
        $path = '<script> window.history.back(); </script>';
        alertBox($status, $title, $icon, $path);
    }
}

if (isset($_GET['deleteEmployeeType'])) {
    $deleteEmployeeType = $_GET['deleteEmployeeType'];

    $sql = "DELETE FROM `employeetype` WHERE `id` = '$deleteEmployeeType'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $status = 'Data deleted successfully';
        $title = 'Success';
        $icon = 'success';
        $path = '<script> window.history.back(); </script>';
        alertBox($status, $title, $icon, $path);
    } else {
        $status = 'Data not deleted';
        $title = 'Error';
        $icon = 'error';
        $path = '<script> window.history.back(); </script>';
        alertBox($status, $title, $icon, $path);
    }
}
/*------------------------------------ Employee -----------------------------------*/

if (isset($_POST['addEmployee'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    if (isset($_POST['gender'])) {
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    }
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $employeeType = mysqli_real_escape_string($conn, $_POST['employeeType']);
    $salaryType = mysqli_real_escape_string($conn, $_POST['salaryType']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    $image_file_name = $_FILES['image']['name'];
    $image_file_tmp = $_FILES['image']['tmp_name'];
    $image_file_size = $_FILES['image']['size'];
    $image_file_extension = pathinfo($image_file_name, PATHINFO_EXTENSION);

    if (empty($name) || empty($email) || empty($phone) || empty($gender) || empty($address) || empty($employeeType) || empty($salaryType) || empty($role) || empty($password) || empty($confirmPassword) || empty($image_file_name)) {
        $error = 'All fields are required';
    } else {
        $pattern = '/^[a-zA-Z]+(([\' -][a-zA-Z ])?[a-zA-Z]*)*$/';
        $email = trim($email);
        $phoneNumber = preg_replace('/\D/', '', $phone);

        if (!preg_match($pattern, $name)) {
            $error = 'Enter valid name';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Enter valid email';
        } else if (!preg_match('/^(98|97|96)\d{8}$/', $phoneNumber)) {
            $error = 'Enter valid phone number';
        } else if (!preg_match('/[a-zA-Z0-9]/', $address)) {
            $error = 'Enter valid address';
        } else if (!is_valid_password($password)) {
            $error = 'Password length must be greater than 7 with uppercase, lowercase, number and special character';
        } else if ($password != $confirmPassword) {
            $error = 'Password and confirm password is not matching';
        } else {
            $select = mysqli_query($conn, "SELECT * FROM `employee` WHERE `email` = '$email' OR `phone` = '$phone'");
            $num = mysqli_num_rows($select);
            if ($num > 0) {
                $error = 'Employee already exist';
            } else {
                $error = checkExtensionAndSize($image_file_extension, $image_file_size);
                if (empty($error)) {
                    $image_new_name = random_int(1000, 9999) . '.' . $image_file_extension;
                    $image_location = '../images/' . $image_new_name;
                    move_uploaded_file($image_file_tmp, $image_location);
                    $id = random_int(1000, 9000);
                    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `employee`(`id`, `name`, `email`, `phone`, `gender`, `address`, `employeeType`, `salaryType`, `image`, `password`, `role`) VALUES ('$id', '$name', '$email', '$phone', '$gender', '$address', '$employeeType', '$salaryType', '$image_new_name', '$hashedPassword', '$role')";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $status = 'Data added successfully';
                        $title = 'Success';
                        $icon = 'success';
                        $path = '<script> window.location.href = "http://localhost/salaryMS/frontend/addemployee.php"; </script>';
                        alertBox($status, $title, $icon, $path);
                    } else {
                        $error = 'Data not added';
                    }
                }
            }
        }
    }
    if (!empty($error)) {
        $status = $error;
        $title = 'Error';
        $icon = 'error';
        $path = '<script> window.history.back(); </script>';
        alertBox($status, $title, $icon, $path);
    }
}

if (isset($_GET['deleteEmployee'])) {
    $deleteEmployee = $_GET['deleteEmployee'];

    $sql = "DELETE FROM `employee` WHERE `id` = '$deleteEmployee'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $status = 'Data deleted successfully';
        $title = 'Success';
        $icon = 'success';
        $path = '<script> window.history.back(); </script>';
        alertBox($status, $title, $icon, $path);
    } else {
        $status = 'Data not deleted';
        $title = 'Error';
        $icon = 'error';
        $path = '<script> window.history.back(); </script>';
        alertBox($status, $title, $icon, $path);
    }
}

/*---------------------------------- Salary Payment --------------------------------*/

if (isset($_POST['setSalaryamount'])) {
    $salaryPaidId = random_int(1000, 9999);
    $employeeId = mysqli_escape_string($conn, $_POST['employeeId']);
    $setYear = mysqli_escape_string($conn, $_POST['setYear']);
    $setSalaryamount = mysqli_escape_string($conn, $_POST['setSalaryamount']);
    $setMonth = mysqli_escape_string($conn, $_POST['setMonth']);
    $setBonus = mysqli_escape_string($conn, $_POST['setBonus']);
    $setVat = mysqli_escape_string($conn, $_POST['setVat']);
    $setVatAmount = mysqli_escape_string($conn, $_POST['setVatAmount']);
    $setPayableAmount = mysqli_escape_string($conn, $_POST['setPayableAmount']);

    if (empty($employeeId) || empty($setYear) || empty($setSalaryamount) || empty($setMonth) || empty($setBonus) || empty($setVat) || empty($setVatAmount) || empty($setPayableAmount)) {
        $error = 'All fields are required';
    } else {
        $sql = mysqli_query($conn, "SELECT * FROM `salarypaid` WHERE `year` = '$setYear' AND `month` = '$setMonth'");
        $num = mysqli_num_rows($sql);
        if ($num == 0) {
            $sql = "INSERT INTO `salarypaid`(`id`, `employeeId`, `year`, `month`, `salary`, `bonus`, `vatPercentage`, `vatAmount`, `totalPaidAmount`) VALUES ('$salaryPaidId','$employeeId','$setYear','$setMonth','$setSalaryamount','$setBonus','$setVat','$setVatAmount','$setPayableAmount')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $status = 'Payment Success';
                $title = 'Success';
                $icon = 'success';
                $path = '<script> window.location.href = "http://localhost/salaryMS/frontend/salaryPayment.php"; </script>';
                alertBox($status, $title, $icon, $path);
            }
        } else {
            $error = "Salary Already Paid";
        }
    }
    if (!empty($error)) {
        $status = $error;
        $title = 'Error';
        $icon = 'error';
        $path = '<script> window.history.back(); </script>';
        alertBox($status, $title, $icon, $path);
    }
}

/*---------------------------------- Edit Profile --------------------------------*/

if (isset($_POST['editProfile'])) {
    $empId = $_POST['empId'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : '';
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $error = "";
    $image = $_FILES['image'];
    $image_file_name = $_FILES['image']['name'];
    $image_file_tmp = $_FILES['image']['tmp_name'];
    $image_file_size = $_FILES['image']['size'];
    $image_file_extension = pathinfo($image_file_name, PATHINFO_EXTENSION);


    $oldImagePath = "../images/" . $_SESSION['image'];

    if (empty($name) || empty($phone) || empty($gender) || empty($address)) {
        $error = 'All fields are required';
    } else {
        $pattern = '/^[a-zA-Z]+(([\' -][a-zA-Z ])?[a-zA-Z]*)*$/';
        $phoneNumber = preg_replace('/\D/', '', $phone);

        if (!preg_match($pattern, $name)) {
            $error = 'Enter valid name';
        } elseif (!preg_match('/^(98|97|96)\d{8}$/', $phoneNumber)) {
            $error = 'Enter valid phone number';
        } elseif (!preg_match('/[a-zA-Z0-9]/', $address)) {
            $error = 'Enter valid address';
        } else {
            if (!empty($image_file_name)) {
                $fileError = checkExtensionAndSize($image_file_extension, $image_file_size);
                if (!empty($fileError)) {
                    $error = $fileError;
                }
            }

            if (empty($error)) {
                if (!empty($image_file_name)) {
                    $file_new_name = strval(random_int(1000, 9999) . '.' . $image_file_extension);
                    $location = '../images/' . $file_new_name;
                    if (move_uploaded_file($image_file_tmp, $location)) {
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    } else {
                        $error = "Failed to upload new image";
                    }
                } else {
                    $file_new_name = $oldImagePath;
                }
            }


            if (empty($error)) {

                $sql = "UPDATE employee SET name='$name', phone='$phone', gender='$gender', address='$address', image='$file_new_name' WHERE id='$empId'";

                if (mysqli_query($conn, $sql)) {
                    $_SESSION['name'] = $name;
                    $_SESSION['phone'] = $phone;
                    $_SESSION['gender'] = $gender;
                    $_SESSION['address'] = $address;
                    $_SESSION['image'] = $file_new_name;

                    $status = 'Profile Updated';
                    $title = 'Success';
                    $icon = 'success';
                    $path = '<script> window.location.href = "http://localhost/salaryMS/frontend/profile.php"; </script>';
                    alertBox($status, $title, $icon, $path);
                } else {
                    echo "Error updating profile: " . mysqli_error($conn);
                }
            }
        }
    }
    if (!empty($error)) {
        $status = $error;
        $title = 'Error';
        $icon = 'error';
        $path = '<script> window.history.back(); </script>';
        alertBox($status, $title, $icon, $path);
    }
}

/*---------------------------------- Change password --------------------------------*/

if (isset($_POST['changePassword'])) {
    $error = '';
    $email = $_SESSION['email'];
    $old = $_POST['password'];
    $new = $_POST['newPassword'];
    $cnew = $_POST['confirmPassword'];

    if (empty($old) && empty($new) && empty($cnew)) {
        $error = 'All fields are required';
    } else {
        $loginQry = "SELECT * FROM `employee` WHERE `email`='$email'";
        $selectLogin = mysqli_query($conn, $loginQry);
        $num = mysqli_num_rows($selectLogin);
        if ($num == 1) {
            while ($row = mysqli_fetch_assoc($selectLogin)) {
                if (!password_verify($old, $row['password'])) {
                    $error = 'Incorrect old password';
                }else if (!is_valid_password($new)) {
                    $error = "Invalid Password";
                } else if ($new != $cnew) {
                    $error = "Password and confirm password do not match";
                } else {
                    $hash = password_hash($new, PASSWORD_DEFAULT);
                    $updateQry = "UPDATE `employee` SET `password` = '$hash' WHERE `email` = '$email'";
                    $result = mysqli_query($conn, $updateQry);
                    if ($result) {
                        $_SESSION['error'] = "";
                        $_SESSION['passwordChanged'] = true;
                        $status = 'Password changed ! Login again';
                        $title = 'Success';
                        $icon = 'success';
                        $dangerMode = 'false';
                        $path = '<script> window.location.href = "http://localhost/salaryMS/frontend/profile.php" </script>';
                    }
                }
            }
        }
    }
    $_SESSION['error'] = $error;
    if (!empty($_SESSION['error'])) {
        $status = $error;
        $title = 'Error';
        $icon = 'error';
        $dangerMode = 'true';
        $path = '<script> window.history.back(); </script>';
    }
    passAlertBox($status, $title, $icon, $dangerMode, $path);
}
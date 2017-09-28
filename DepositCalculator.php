<!DOCTYPE html>
<html>

<head>
    <title>Deposit Calculator</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
        function ValidatePrincipalAmount($amount) {
            if ($amount === ""){
                return "Principal amount is required";
            }
            if (preg_match("/^\d+$/", $amount) === 1) {
                return "";
            }
            return "Principal amount must be numeric";
        }
        function ValidateInterestRate($rate) {
            if ($rate === "") {
                return "Interest rate is required";
            }
            if (preg_match("/^\d+$/", $rate) === 1){
                return "";
            }
            return "Interest rate must be non-negative numeric";
        }
        function ValidateDepositYears($years) {
            if ($years === "") {
                return "Years to deposit is required";
            }
            if (preg_match("/^((20)|(1\d)|(0[1-9])|[1-9])$/", $years) === 1) {
                return "";
            }
            return "Years to deposit must be numeric and between 1 and 20";
        }
        function ValidateName($name) {
            if ($name === "") {
                return "Name is required";
            }
            return "";
        }
        function ValidatePostalCode($postalCode) {
            if ($postalCode === "") {
                return "Postal code is required";
            }
            if (preg_match("/[a-z]\d[a-z]\ ?\d[a-z]\d$/i", $postalCode) === 1) {
                return "";
            }
            return "Postal code is invalid";
        }
        function ValidatePhoneNumber($phoneNumber) {
            if ($phoneNumber === "") {
                return "Phone number is required";
            }
            if (preg_match("/[2-9]\d\d\-[2-9]\d\d\-\d{4}$/", $phoneNumber) === 1) {
                return "";
            }
            return "Phone number is invalid";
        }
        function ValidateEmailAddress($emailAddress) {
            if ($emailAddress === "") {
                return "Email address is required";
            }
            if (preg_match("/[A-Za-z\d.]+\@[A-Za-z\d]+\.[A-Za-z.]{2,4}$/", $emailAddress) === 1) {
                return "";
            }
            return "Email address is invalid";
        }
        $valid = FALSE;
        if (!empty($_POST)) {
            extract($_POST);
            $error = array();
            $principalAmountError = ValidatePrincipalAmount($principalAmount);
            if ($principalAmountError !== "") {
                $error["principalAmount"] = $principalAmountError;
            }
            $interestRateError = ValidateInterestRate($interestRate);
            if ($interestRateError !== "") {
                $error["interestRate"] = $interestRateError;
            }
            $depositYearsError = ValidateDepositYears($depositYears);
            if ($depositYearsError !== "") {
                $error["depositYears"] = $depositYearsError;
            }
            $nameError = ValidateName($name);
            if ($nameError !== "") {
                $error["name"] = $nameError;
            }
            $postalCodeError = ValidatePostalCode($postalCode);
            if ($postalCodeError !== "") {
                $error["postalCode"] = $postalCodeError;
            }
            $phoneNumberError = ValidatePhoneNumber($phoneNumber);
            if ($phoneNumberError !== "") {
                $error["phoneNumber"] = $phoneNumberError;
            }
            $emailAddressError = ValidateEmailAddress($emailAddress);
            if ($emailAddressError !== "") {
                $error["emailAddress"] = $emailAddressError;
            }
            if (!isset($contactMethod)) {
                $error["contactMethod"] = "Contact method is required";
            }
            if ($contactMethod === "phone" && !isset($phoneTime)) {
                $error["phoneTime"] = "If phone is contact method, time must be selected";
            }
            if (empty($error)) {
                $valid = TRUE;
            }
        }
    ?>
</head>

<body>
    <?php if (!$valid) : ?>
    <div class="form-panel container">
        <h1>Deposit Calculator</h1>
        <form action="DepositCalculator.php" name="depositCalculator" method="post">
            <div class="form-group row">
                <label for="principalAmount" class="col-sm-3 col-form-label">Principal Amount:</label>
                <div class="col-sm-9">
                    <input type="text" name="principalAmount" id="principalAmount" class="form-control" />
                    <?php if (!empty($error["principalAmount"])) : ?>
                    <div class="alert alert-danger">
                    <?php echo $error["principalAmount"]; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="interestRate" class="col-sm-3 col-form-label">Interest Rate (%):</label>
                <div class="col-sm-9">
                    <input type="text" name="interestRate" id="interestRate" class="form-control" />
                    <?php if (!empty($error["interestRate"])) : ?>
                    <div class="alert alert-danger">
                    <?php echo $error["interestRate"]; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="depositYears" class="col-sm-3 col-form-label">Years to Deposit:</label>
                <div class="col-sm-9">
                    <input type="number" name="depositYears" id="depositYears" class="form-control" />
                    <?php if (!empty($error["depositYears"])) : ?>
                    <div class="alert alert-danger">
                    <?php echo $error["depositYears"]; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <hr/>
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Name:</label>
                <div class="col-sm-9">
                    <input type="text" name="name" id="name" class="form-control" />
                    <?php if (!empty($error["name"])) : ?>
                    <div class="alert alert-danger">
                    <?php echo $error["name"]; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="postalCode" class="col-sm-3 col-form-label">Postal Code:</label>
                <div class="col-sm-9">
                    <input type="text" name="postalCode" id="postalCode" class="form-control" />
                    <?php if (!empty($error["postalCode"])) : ?>
                    <div class="alert alert-danger">
                    <?php echo $error["postalCode"]; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="phoneNumber" class="col-sm-3 col-form-label">Phone Number:
                    <small id="passwordHelpBlock" class="form-text text-muted">(nnn-nnn-nnnn)</small>
                </label>
                <div class="col-sm-9">
                    <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" />
                    <?php if (!empty($error["phoneNumber"])) : ?>
                    <div class="alert alert-danger">
                    <?php echo $error["phoneNumber"]; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="emailAddress" class="col-sm-3 col-form-label">Email Address:</label>
                <div class="col-sm-9">
                    <input type="text" name="emailAddress" id="emailAddress" class="form-control" />
                    <?php if (!empty($error["emailAddress"])) : ?>
                    <div class="alert alert-danger">
                    <?php echo $error["emailAddress"]; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <hr/>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Preferred Contact Method:</label>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <label for="radioPhone" class="form-check-label">
                            <input type="radio" name="contactMethod" id="radioPhone" value="phone" class="form-check-input" />
                            Phone
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label for="radioEmail" class="form-check-label">
                            <input type="radio" name="contactMethod" id="radioEmail" value="email" class="form-check-input" />
                            Email
                        </label>
                    </div>
                    <?php if (!empty($error["contactMethod"])) : ?>
                    <div class="alert alert-danger">
                    <?php echo $error["contactMethod"]; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <label class="col-sm-3 col-form-label">If phone is selected, when can we contact you? (Check all applicable)</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <label for="checkMorning" class="form-check-label">
                                <input type="checkbox" name="phoneTime[]" value="morning" id="checkMorning" class="form-check-input" />
                                Morning
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label for="checkAfternoon" class="form-check-label">
                                <input type="checkbox" name="phoneTime[]" value="afternoon" id="checkAfternoon" class="form-check-input" />
                                Afternoon
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label for="checkEvening" class="form-check-label">
                                <input type="checkbox" name="phoneTime[]" value="evening" id="checkEvening" class="form-check-input" />
                                Evening
                            </label>
                        </div>
                    <?php if (!empty($error["phoneTime"])) : ?>
                        <div class="alert alert-danger">
                        <?php echo $error["phoneTime"]; ?>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
            </fieldset>
            <div class="form-group">
                <input type="submit" name="submit" id="submit" value="Calculate" class="btn btn-primary">
                <input type="reset" name="reset" id="reset" value="Clear" class="btn btn-primary">
            </div>
        </form>
    </div>
    <?php endif; ?>
    
    <?php if ($valid) : ?>
    <div class="result-panel container">
        <h1>Thank you<?php if ($name != "") { echo ", <span class='text-primary'>" . $name . "</span>,"; } ?> for using our deposit calculator!</h1>
        
        <div class="div-success">
            <?php if ($contactMethod === "phone") : ?>
                <p>Our customer service department will call you tomorrow <?php for ($i = 0; $i < count($phoneTime); $i++) { if ($i < count($phoneTime) - 1) { echo $phoneTime[$i] . " or "; continue; } echo $phoneTime[$i]; } ?> at <?php echo $phoneNumber; ?>.</p>
            <?php endif; ?>
            <?php if ($contactMethod === "email") : ?>
                <p>Our customer service department will email you tomorrow at <?php echo $emailAddress; ?>.</p>
            <?php endif; ?>
            <br />
            <p>The following is the result of the calculation:</p>
            <table id="tblResult" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Principal at Year Start</th>
                        <th>Interest for the Year</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 1; $i <= $depositYears; $i++) : ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php printf("\$%.2f", $principalAmount); ?></td>
                        <td><?php $interest = $principalAmount * $interestRate / 100; $principalAmount += $interest; printf("\$%.2f", $interest); ?></td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($_POST)) : ?>
    <script>
    <?php foreach ($_POST as $field => $value) : ?>
        <?php if ($value !== "" && $field !== "submit" && $field !== "phoneTime") : ?>
        document.depositCalculator.<?php echo $field; ?>.value = <?php echo '"' . $value . '"'; ?>;
        <?php endif; ?>
        <?php if ($value !== array() && $field === "phoneTime") : ?>
        <?php foreach ($phoneTime as $time) : ?>
            document.getElementById(<?php echo '"check' . ucfirst($time) . '"'?>).checked = true;
        <?php endforeach; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    </script>
    <?php endif; ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</body>

</html>
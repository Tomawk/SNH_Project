<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Address and Credit Card Info</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
      padding: 40px;
      width: 400px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    input[type="text"],
    input[type="number"],
    input[type="tel"],
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #4caf50;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    label {
      font-weight: bold;
    }

    .card-info {
      display: flex;
      gap: 10px;
    }

    .card-info input {
      flex: 1;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Enter Address and Credit Card Info</h1>
    <form action="#">
      <label for="fullname">Full Name:</label>
      <input type="text" id="fullname" name="fullname" required>

      <label for="address">Address:</label>
      <input type="text" id="address" name="address" required>

      <label for="city">City:</label>
      <input type="text" id="city" name="city" required>

      <label for="country">Country:</label>
      <select id="country" name="country" required>
        <option value="">Select Country</option>
        <!-- Add country options here -->
        <option value="USA">United States</option>
        <option value="UK">United Kingdom</option>
        <option value="CA">Canada</option>
        <!-- Add more countries as needed -->
      </select>

      <label for="cardnumber">Card Number:</label>
      <input type="text" id="cardnumber" name="cardnumber" required>

      <div class="card-info">
        <div>
          <label for="expiration">Expiration Date:</label>
          <input type="text" id="expiration" name="expiration" placeholder="MM/YY" required>
        </div>
        <div>
          <label for="cvv">CVV:</label>
          <input type="text" id="cvv" name="cvv" required>
        </div>
      </div>

      <input type="submit" value="Submit">
    </form>
  </div>
</body>
</html>

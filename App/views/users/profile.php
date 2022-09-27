<?php require_once "views/components/header.php"?>

<div id="profile-div">
    <h1>Profile</h1>
    <hr>

    <form action="/changePassword" method="post">
        <div id="profile-form-div">
        
            <input hidden name="_method" value="PUT">
            <table class="profile-table">
                <tr>
                    <th>Name</th>
                    <td><?php echo $data["user"]["name"] ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $data["user"]["email"] ?></td>
                </tr>
            </table>

            <h2>Change Password</h2>
            <hr>
            <table class="profile-table">
                <tr>
                    <th>Current Password</th>
                    <td>
                        <input type="password" name="currentPassword" required>
                    </td>
                </tr>
                <tr>
                    <th>New Password</th>
                    <td>
                        <input type="password" name="newPassword" required>
                    </td>
                </tr>
                <tr>
                    <th>Confirm New Password</th>
                    <td>
                        <input type="password" name="newPasswordConfirm" required>
                    </td>
                </tr>
            </table>

            <div class="center">
                <button type="submit" class="medium-button">Confirm</button>
            </div>
        </div>
    </form>
</div>

<?php require_once "views/components/footer.php"?>
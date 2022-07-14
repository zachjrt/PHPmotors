<div id="add-review">
    <h2>Review the <?php echo $vehicle['invMake']." ".$vehicle['invModel']; ?></h2>
    <form method="post" action="/phpmotors/reviews/index.php">

    <label for="screenName">Screen Name:</label><br>
    <input name="screenName" id="screenName" type="text" <?php if(isset($screenName)){echo "value='$screenName'";} ?> required>
    <br>

    <label for="review">Review:</label><br>
    <textarea id="review" name="review" rows="4" cols="50" placeholder="Type review here">
    </textarea>

    <input class="submitButton" type="submit" value="Submit Review">
    <input type="hidden" name="action" value="add-review">
    </form>
</div>
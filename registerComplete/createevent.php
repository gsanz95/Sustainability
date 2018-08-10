<?php
require "./navbar.php";

echo " <div class='header pl-3 pt-3'>
 <h1>Create Event</h1>
 </div>
<form class='mx-sm-3 w-50' action='../scripts/eventcreator.php' method='post'>
    <div class='form-group'>
        <label for='event_name'>Event Title:</label>
        <input type='text' class='form-control' id='event_name' name='event_name' placeholder='Event Title' required>
    </div>
    <div class='form-group'>
        <label for='event_description'>Description:</label>
        <textarea type='text' class='form-control' id='event_description' name='event_description' placeholder='Tell us about your event'></textarea>
    </div>
    <div class='form-group'>
        <label for='event_type'>Event Type:</label>
        <select class='form-control' id='event_type' name='event_type' required>
            <option value=''>N/A</option>
            <option value='gathering'>Community Gathering</option>
            <option value='volunteering'>Volunteering Event</option>
            <option value='educating'>Educational Event</option>
        </select>
    </div>
    <div class='form-group'>
        <label for='event_location_name'>Location Name:</label>
        <input type='text' class='form-control' id='event_location_name' name='event_location_name' required>
    </div>
    <div class='form-group'>
        <label for='event_location_address'>Address:</label>
        <input type='text' class='form-control' id='event_location_address' name='event_location_address'>
    </div>
    <div class='form-group row'>
        <div class='col'>
            <label for='event_location_city'>City:</label>
            <input type='text' class='form-control' id='event_location_city' name='event_location_city'>
        </div>
        <div class='col'>
            <label for='event_location_state'>State:</label>
            <select class='form-control' id='event_location_state' name='event_location_state' required>
                  <option value=\"\" selected=\"selected\">Select a State</option>
                  <option value=\"AL\">Alabama</option>
                  <option value=\"AK\">Alaska</option>
                  <option value=\"AZ\">Arizona</option>
                  <option value=\"AR\">Arkansas</option>
                  <option value=\"CA\">California</option>
                  <option value=\"CO\">Colorado</option>
                  <option value=\"CT\">Connecticut</option>
                  <option value=\"DE\">Delaware</option>
                  <option value=\"DC\">District Of Columbia</option>
                  <option value=\"FL\">Florida</option>
                  <option value=\"GA\">Georgia</option>
                  <option value=\"HI\">Hawaii</option>
                  <option value=\"ID\">Idaho</option>
                  <option value=\"IL\">Illinois</option>
                  <option value=\"IN\">Indiana</option>
                  <option value=\"IA\">Iowa</option>
                  <option value=\"KS\">Kansas</option>
                  <option value=\"KY\">Kentucky</option>
                  <option value=\"LA\">Louisiana</option>
                  <option value=\"ME\">Maine</option>
                  <option value=\"MD\">Maryland</option>
                  <option value=\"MA\">Massachusetts</option>
                  <option value=\"MI\">Michigan</option>
                  <option value=\"MN\">Minnesota</option>
                  <option value=\"MS\">Mississippi</option>
                  <option value=\"MO\">Missouri</option>
                  <option value=\"MT\">Montana</option>
                  <option value=\"NE\">Nebraska</option>
                  <option value=\"NV\">Nevada</option>
                  <option value=\"NH\">New Hampshire</option>
                  <option value=\"NJ\">New Jersey</option>
                  <option value=\"NM\">New Mexico</option>
                  <option value=\"NY\">New York</option>
                  <option value=\"NC\">North Carolina</option>
                  <option value=\"ND\">North Dakota</option>
                  <option value=\"OH\">Ohio</option>
                  <option value=\"OK\">Oklahoma</option>
                  <option value=\"OR\">Oregon</option>
                  <option value=\"PA\">Pennsylvania</option>
                  <option value=\"RI\">Rhode Island</option>
                  <option value=\"SC\">South Carolina</option>
                  <option value=\"SD\">South Dakota</option>
                  <option value=\"TN\">Tennessee</option>
                  <option value=\"TX\">Texas</option>
                  <option value=\"UT\">Utah</option>
                  <option value=\"VT\">Vermont</option>
                  <option value=\"VA\">Virginia</option>
                  <option value=\"WA\">Washington</option>
                  <option value=\"WV\">West Virginia</option>
                  <option value=\"WI\">Wisconsin</option>
                  <option value=\"WY\">Wyoming</option>
            </select>
        </div>
        <div class='col'>
            <label for='event_location_zip'>Zip Code:</label>
            <input type='text' class='form-control' id='event_location_zip' name='event_location_zip' placeholder='#####'>
        </div>
    </div>
    <div class='form-group'>
        <label for='event_startdatetime'>Starting Date & Time:</label>
        <input type='datetime-local' class='form-control' id='event_startdatetime' name='event_startdatetime' required>
    </div>
    <div class='form-group'>
        <label for='event_enddatetime'>Ending Date & Time:</label>
        <input type='datetime-local' class='form-control' id='event_enddatetime' name='event_enddatetime'>
    </div>
    <button type='submit'  class='btn btn-primary float-right'>Create Event</button>
</form>
";
/**
 *
 *
 * Created by PhpStorm.
 * User: Giancarlo
 * Date: 7/21/2018
 * Time: 2:59 PM
 */

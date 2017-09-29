# How to start it up ?
 <ul>
  <li>Import project Database to <strong>phpMyAdmin</strong></li>
  <li>Download project files then run it on localhost or your own host</li>
  <li><code>inc/all/config.php</code> Edit your connection informations</li>
  <li>Database is called <code>resume</code></li>
 </ul>
 
 # Creating a new controller 
  - Go to resume database
  - Go to controllers table
  - Enter your informations<br>
  Notice: <strong><code>Password must be hashed to <i>sha1()</i></code></strong>

  <h5>Go to <code>host/cousres/admin/</code></h5>
  Enter your username and your password
  
  # Admin Control Panel Features
   - users_actions: ['Edit', 'Delete', 'New', 'View']
   - courses_actions: @extend user_actions
   - controller_actions: @extend user_actions
   - Messages ( Contact Form )
   - Admin Profile
   - Admin Edit Informations
   
  # Admin Informations 
   - Social Media Accounts
   - Username, Fullname, Password, Email
   - Edit job, college

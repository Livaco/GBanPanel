// Version Check
local RanCheck = false
hook.Add("PlayerConnect", "gbanpanel_versioncheck", function()
  if(RanCheck == true) then return end
  GBanPanel.Print("Running version check!")
  // Post request.
  http.Post("https://livacoweb.000webhostapp.com/libaries/versions/gbanpanel.php", {RunningVar = "1.0"}, function(result)
    GBanPanel.Print(result)
  end, function(fail)
    GBanPanel.Print("Error: " .. fail)
    GBanPanel.Print("This is most likely due to my website being down. Try again later.")
  end)
  RanCheck = true
end)


function GBanPanel.AddBan(data)
  /*
  data
    User
    Admin
    Reason
    Time
    Unban
  */
  http.Post(GBanPanel.Config.URL .. "/assets/api.php", {
    SteamAPIKey = GBanPanel.Config.SteamAPI,
    Password = GBanPanel.Config.Password,
    User = data.User,
    Admin = data.Admin,
    Reason = data.Reason,
    Timee = tostring(data.Time),
    Unban = tostring(data.Unban)
  }, function(Responce)
    GBanPanel.Print(Responce)
  end, function()
    GBanPanel.Print("Unable to connect. Check your URLs!")
  end)
end

hook.Add("ULibPlayerBanned", "gbanpanel_ban", function(sid, bandata)
  local Name = "Disconnected"
  local Reason = "None"
  if(bandata.name) then
    Name = bandata.name
  end
  if(bandata.reason) then
    Reason = bandata.reason
  end
  GBanPanel.AddBan({
    User = Name .. " ("..sid..")",
    Admin = bandata.admin,
    Reason = Reason,
    Time = bandata.time,
    Unban = bandata.unban
  })
  return true
end)
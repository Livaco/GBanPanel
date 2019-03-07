GBanPanel = {}
GBanPanel.Config = GBanPanel.Config or {}
function GBanPanel.Print(msg)
  MsgC(Color(200, 0, 200), "[GBanPanel] ")
  MsgC(Color(255, 255, 255), msg)
  MsgC(Color(255, 255, 255), "\n")
end

if(SERVER) then
  GBanPanel.Print("Initializing.")
  include("gbanpanel/config/config.lua") GBanPanel.Print("config.lua")
  include("gbanpanel/core/sv_main.lua") GBanPanel.Print("sv_main.lua")
end
json.array!(@servers) do |server|
  json.extract! server, :id, :name, :hostname, :description
  json.url server_url(server, format: :json)
end

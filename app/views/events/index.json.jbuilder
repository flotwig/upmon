json.array!(@events) do |event|
  json.extract! event, :id, :description
  json.url event_url(event, format: :json)
end

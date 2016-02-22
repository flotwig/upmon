json.array!(@aspects) do |aspect|
  json.extract! aspect, :id, :name, :last_up
  json.url aspect_url(aspect, format: :json)
end

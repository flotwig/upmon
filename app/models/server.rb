class Server < ActiveRecord::Base
  has_many :events
  has_many :aspects
  has_one :state
end

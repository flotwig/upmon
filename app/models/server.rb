class Server < ActiveRecord::Base
  has_many :events
  has_many :aspects
  belongs_to :state
end

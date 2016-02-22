class Aspect < ActiveRecord::Base
  belongs_to :server
  has_one :type
  has_one :state
  has_many :events
end

class Aspect < ActiveRecord::Base
  belongs_to :server
  belongs_to :type
  belongs_to :state
  has_many :events
end

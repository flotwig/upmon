class Event < ActiveRecord::Base
  belongs_to :aspect
  belongs_to :server
end

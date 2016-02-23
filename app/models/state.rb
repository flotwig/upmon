class State < ActiveRecord::Base
  has_many :servers
  has_many :aspects
end

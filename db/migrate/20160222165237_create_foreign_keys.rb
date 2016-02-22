class CreateForeignKeys < ActiveRecord::Migration
  def up
    add_foreign_key :aspects, :servers
    add_foreign_key :aspects, :types
    add_foreign_key :aspects, :states
    add_foreign_key :events, :aspects
    add_foreign_key :events, :servers
    add_foreign_key :servers, :states
  end
  def down
    remove_foreign_key :aspects, :servers
    remove_foreign_key :aspects, :types
    remove_foreign_key :aspects, :states
    remove_foreign_key :events, :aspects
    remove_foreign_key :events, :servers
    remove_foreign_key :servers, :states
  end
end

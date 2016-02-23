class CreateForeignKeyColumns < ActiveRecord::Migration
  def up
    add_column :aspects, :server_id, :integer
    add_column :aspects, :type_id, :integer
    add_column :aspects, :state_id, :integer
    add_column :events, :aspect_id, :integer
    add_column :events, :server_id, :integer
    add_column :servers, :state_id, :integer
  end
  def down
    remove_column :aspects, :server_id
    remove_column :aspects, :type_id
    remove_column :aspects, :state_id
    remove_column :events, :aspect_id
    remove_column :events, :server_id
    remove_column :servers, :state_id
  end
end

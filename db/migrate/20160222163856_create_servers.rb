class CreateServers < ActiveRecord::Migration
  def change
    create_table :servers do |t|
      t.string :name
      t.string :hostname
      t.string :description

      t.timestamps null: false
    end
  end
end

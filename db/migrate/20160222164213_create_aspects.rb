class CreateAspects < ActiveRecord::Migration
  def change
    create_table :aspects do |t|
      t.string :name
      t.datetime :last_up

      t.timestamps null: false
    end
  end
end

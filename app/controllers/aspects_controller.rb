class AspectsController < ApplicationController
  before_action :set_aspect, only: [:show]

  # GET /aspects
  # GET /aspects.json
  def index
    @aspects = Aspect.all
  end

  # GET /aspects/1
  # GET /aspects/1.json
  def show
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_aspect
      @aspect = Aspect.find(params[:id])
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def aspect_params
      params.require(:aspect).permit(:name, :last_up)
    end
end

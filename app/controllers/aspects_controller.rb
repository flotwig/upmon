class AspectsController < ApplicationController
  before_action :set_aspect, only: [:show, :edit, :update, :destroy]

  # GET /aspects
  # GET /aspects.json
  def index
    @aspects = Aspect.all
  end

  # GET /aspects/1
  # GET /aspects/1.json
  def show
  end

  # GET /aspects/new
  def new
    @aspect = Aspect.new
  end

  # GET /aspects/1/edit
  def edit
  end

  # POST /aspects
  # POST /aspects.json
  def create
    @aspect = Aspect.new(aspect_params)

    respond_to do |format|
      if @aspect.save
        format.html { redirect_to @aspect, notice: 'Aspect was successfully created.' }
        format.json { render :show, status: :created, location: @aspect }
      else
        format.html { render :new }
        format.json { render json: @aspect.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /aspects/1
  # PATCH/PUT /aspects/1.json
  def update
    respond_to do |format|
      if @aspect.update(aspect_params)
        format.html { redirect_to @aspect, notice: 'Aspect was successfully updated.' }
        format.json { render :show, status: :ok, location: @aspect }
      else
        format.html { render :edit }
        format.json { render json: @aspect.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /aspects/1
  # DELETE /aspects/1.json
  def destroy
    @aspect.destroy
    respond_to do |format|
      format.html { redirect_to aspects_url, notice: 'Aspect was successfully destroyed.' }
      format.json { head :no_content }
    end
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

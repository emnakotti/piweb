#include "prediction.h"
#include "ui_prediction.h"

prediction::prediction(QWidget *parent)
    : QMainWindow(parent)
    , ui(new Ui::prediction)
{
    ui->setupUi(this);
}

prediction::~prediction()
{
    delete ui;
}


#include "tuniartisia.h"
#include "ui_tuniartisia.h"

tuniartisia::tuniartisia(QWidget *parent)
    : QMainWindow(parent)
    , ui(new Ui::tuniartisia)
{
    ui->setupUi(this);
}

tuniartisia::~tuniartisia()
{
    delete ui;
}


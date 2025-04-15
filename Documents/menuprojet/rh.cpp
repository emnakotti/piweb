#include "rh.h"
#include "ui_rh.h"

RH::RH(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::RH)
{
    ui->setupUi(this);
}

RH::~RH()
{
    delete ui;
}

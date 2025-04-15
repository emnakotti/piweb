#include "oeuvres.h"
#include "ui_oeuvres.h"

oeuvres::oeuvres(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::oeuvres)
{
    ui->setupUi(this);
}

oeuvres::~oeuvres()
{
    delete ui;
}

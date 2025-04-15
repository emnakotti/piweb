#include "oeuvres.h"
#include "ui_oeuvres.h"

Oeuvres::Oeuvres(QWidget *parent)
    : QMainWindow(parent)
    , ui(new Ui::Oeuvres)
{
    ui->setupUi(this);
}

Oeuvres::~Oeuvres()
{
    delete ui;
}


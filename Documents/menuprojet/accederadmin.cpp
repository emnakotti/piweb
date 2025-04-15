#include "accederadmin.h"
#include "ui_accederadmin.h"

accederadmin::accederadmin(QWidget *parent) :
    QDialog(parent),
    ui(new Ui::accederadmin)
{
    ui->setupUi(this);
}

accederadmin::~accederadmin()
{
    delete ui;
}

#include "evenement.h"
#include "ui_evenement.h"

Evenement::Evenement(QWidget *parent)
    : QMainWindow(parent)
    , ui(new Ui::Evenement)
{
    ui->setupUi(this);
}

Evenement::~Evenement()
{
    delete ui;
}


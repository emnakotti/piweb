#include "connection.h"
#include "ui_connection.h"

connection::connection(QWidget *parent) :
    QDialog(parent),
    ui(new Ui::connection)
{
    ui->setupUi(this);
}

connection::~connection()
{
    delete ui;
}

#include "employees.h"
#include "ui_employees.h"

Employees::Employees(QWidget *parent)
    : QMainWindow(parent)
    , ui(new Ui::Employees)
{
    ui->setupUi(this);
}

Employees::~Employees()
{
    delete ui;
}


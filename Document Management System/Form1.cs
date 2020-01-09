using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Document_Management_System
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();

            string connectionStr = "";

            using (SqlConnection con = new SqlConnection(connectionStr))
            {

            }
        }
    }
}

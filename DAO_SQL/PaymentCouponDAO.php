<?php
    namespace DAO_SQL;

    use DAO_SQL\I_DAO as I_DAO;
    use Models\PaymentCoupon as PaymentCoupon;

    // use to bdd
    use DAO_SQL\Connection as Connection;
    use Exception;
    use PDOException;

    class PaymentCouponDAO implements I_DAO
    {
        private $connection;
        private $tableName = "paymentcoupon";

        public function Add(PaymentCoupon $paymentCoupon)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "INSERT INTO $this->tableName (id_reservation, id_pet, id_owner, coupon_cost)
                      VALUES (:id_reservation, :id_pet, :id_owner, :coupon_cost)";

                $parameters['id_reservation'] = $paymentCoupon->getId_reservation();
                $parameters['id_pet'] = $paymentCoupon->getId_pet();
                $parameters['id_owner'] = $paymentCoupon->getId_owner();
                $parameters['coupon_cost'] = $paymentCoupon->getCoupon_cost();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (Exception $e)
            {
                throw $e;
            }
        }

        public function GetAll()
        {
            try
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName";
                $rta = $this->connection->Execute($query);
            }
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                foreach ($rta as $row) 
                {
                    $coupon = $this->map($row);
                    array_push($couponList, $coupon);
                }
            }

            return $couponList;
        }
        
        public function GetById($id)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName WHERE id_payment_coupon = :id ";
                $parameters['id'] = $id;

                $rta = $this->connection->Execute($query, $parameters);
            } 
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                foreach ($rta as $row) 
                {
                    return $this->map($row);
                }
            }
        }

        public function GetByReservation($id_reserv, $id_pet)
        {
            try 
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM $this->tableName WHERE id_reservation = :id_reservation AND id_pet = :id_pet ";
                $parameters['id_reservation'] = $id_reserv;
                $parameters['id_pet'] = $id_pet;

                $rta = $this->connection->Execute($query, $parameters);
            } 
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                foreach ($rta as $row) 
                {
                    return $this->map($row);
                }
            }
        }

        public function IsExist_Coupon($id_owner)
        {
            try
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM pets_x_reservation WHERE id_owner = :id_owner";
                $parameters['id_owner'] = $id_owner;

                $rta = $this->connection->Execute($query, $parameters);
            }
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function GetByOwner($id_reserv, $id_owner) // esta se va a usar para listaros en el owner
        {
            $reservList = array();
            
            try
            {
                $this->connection = Connection::GetInstance();
                $query = "SELECT * FROM pets_x_reservation WHERE id_reservation = :id_reservation AND id_owner = :id_owner";
                $parameters['id_reservation'] = $id_reserv;
                $parameters['id_owner'] = $id_owner;

                $rta = $this->connection->Execute($query, $parameters);
            }
            catch (Exception $e) 
            {
                throw $e;
            }

            if(!empty($rta))
            {
                foreach ($rta as $row) 
                {
                    return $this->map($row);
                }
            }
        }

        public function ChangeToPayment($id) // para cambiar a is_payment = 1 (fue pago)
        {
            try
            {
                $this->connection = Connection::GetInstance();

                $query = "UPDATE $this->tableName SET is_payment = :is_payment
                            WHERE id_payment_coupon = :id";
                $parameters['is_payment'] = 1;
                $parameters['id'] = $id;

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (Exception $e)
            {
                throw $e;
            }
        }
        
        public function Remove($id)
        {
            try {
                $this->connection = Connection::GetInstance();
                $query = "DELETE FROM $this->tableName WHERE id_payment_coupon = :id";
                $parameters['id'] = $id;

                $rta = $this->connection->ExecuteNonQuery($query, $parameters);
                
                return $rta;
            } 
            catch (Exception $e) 
            {
                throw $e;
            }
        }

        /**
        *	@param Array -> listado que se transforma en objeto
        */

        protected function map ($p)
        {
            $paymentCoupon = new PaymentCoupon();

            $paymentCoupon->setId_paymentCoupon($p['id_payment_coupon']);
            $paymentCoupon->setId_reservation($p['id_reservation']);
            $paymentCoupon->setId_pet($p['id_pet']);
            $paymentCoupon->setId_owner($p['id_owner']);
            $paymentCoupon->setIs_payment($p['is_payment']);
            $paymentCoupon->setCoupon_cost($p['coupon_cost']);

            return $paymentCoupon;
        }
    }
?>
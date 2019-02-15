<?php
class User
{

    protected $errors = [],
    $username,
    $email,
    $password,
    $admin,
    $rememberToken,
    $confirmationToken,
    $confirmedAt,
    $resetToken,
        $resetAt;

    const INVALID_USERNAME = 1;
    const INVALID_EMAIL = 2;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $attr => $value) {
            $method = 'set' . ucfirst($attr);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }

    public function str_random($length)
    {

        $alphabet = "01234566789azertyuioopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";

        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    /**
     * Get the value of _id
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        if (!is_string($username) || empty($username)) {
            $this->errors[] = self::INVALID_USERNAME;
        } else {
            $this->username = $username;
        }

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        if (!is_string($email) || empty($email)) {
            $this->errors[] = self::INVALID_EMAIL;
        } else {
            $this->email = $email;
        }

        return $this;
    }

    /**
     * Get the value of admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set the value of admin
     *
     * @return  self
     */
    public function setAdmin($admin)
    {
        $this->admin = (int) $admin;

        return $this;
    }

    /**
     * Get the value of rememberToken
     */
    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    /**
     * Set the value of rememberToken
     *
     * @return  self
     */
    public function setRememberToken($length)
    {
        $this->rememberToken = $this->str_random($length);

        return $this;
    }

    /**
     * Get the value of confirmationToken
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * Set the value of confirmationToken
     *
     * @return  self
     */
    public function setConfirmationToken($length)
    {
        $this->confirmationToken = $this->str_random($length);

        return $this;
    }

    /**
     * Get the value of confirmedAt
     */
    public function getConfirmedAt()
    {
        return $this->confirmedAt;
    }

    /**
     * Set the value of confirmedAt
     *
     * @return  self
     */
    public function setConfirmedAt(DATETIME $confirmedAt)
    {
        $this->confirmedAt = $confirmedAt;

        return $this;
    }

    /**
     * Get the value of resetToken
     */
    public function getResetToken()
    {
        return $this->resetToken;
    }

    /**
     * Set the value of resetToken
     *
     * @return  self
     */
    public function setResetToken($length)
    {
        $this->resetToken = $this->str_random($length);

        return $this;
    }

    /**
     * Get the value of resetAt
     */
    public function getResetAt()
    {
        return $this->resetAt;
    }

    /**
     * Set the value of resetAt
     *
     * @return  self
     */
    public function setResetAt(DATETIME $resetAt)
    {
        $this->resetAt = $resetAt;

        return $this;
    }
}

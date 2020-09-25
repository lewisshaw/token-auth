<?php
namespace TokenAuth\Data\Repository\RefreshToken;

interface DeleteRefreshTokenInterface
{
    public function delete(int $userId);
}
